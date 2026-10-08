<?php

namespace Botble\CarRentals\Tables\BulkActions;

use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Base\Models\BaseModel;
use Botble\CarRentals\Models\Car;
use Botble\Table\Abstracts\TableBulkActionAbstract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CloneCarsBulkAction extends TableBulkActionAbstract
{
    public function __construct()
    {
        $this
            ->label('Clone selected cars')
            ->confirmationModalTitle('Clone cars')
            ->confirmationModalMessage('Are you sure you want to clone the selected cars?')
            ->confirmationModalButton('Clone');
    }

    public function dispatch(BaseModel|Model $model, array $ids): BaseHttpResponse
    {
        $cars = $model->newQuery()->whereKey($ids)->get();

        DB::transaction(function () use ($cars): void {
            foreach ($cars as $car) {
                if (! $car instanceof Car) {
                    continue;
                }

                $clone = $car->replicate();
                $clone->save();

                foreach (['tags', 'categories', 'colors', 'amenities'] as $relation) {
                    $clone->{$relation}()->sync($car->{$relation}()->allRelatedIds());
                }

                foreach ($car->carDates as $carDate) {
                    $clonedCarDate = $carDate->replicate();
                    $clonedCarDate->car_id = $clone->getKey();
                    $clonedCarDate->save();
                }
            }
        });

        return BaseHttpResponse::make()
            ->setMessage('Selected cars have been cloned successfully.');
    }
}
