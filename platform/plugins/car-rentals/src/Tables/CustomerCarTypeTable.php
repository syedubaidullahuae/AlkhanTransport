<?php

namespace Botble\CarRentals\Tables;

use Botble\CarRentals\Models\CustomerCarType;
use Botble\Table\Abstracts\TableAbstract;
use Botble\Table\Actions\DeleteAction;
use Botble\Table\Actions\EditAction;
use Botble\Table\BulkActions\DeleteBulkAction;
use Botble\Table\Columns\Column;
use Botble\Table\Columns\CreatedAtColumn;
use Botble\Table\Columns\IdColumn;
use Botble\Table\Columns\ImageColumn;
use Botble\Table\Columns\NameColumn;
use Botble\Table\Columns\StatusColumn;
use Botble\Table\HeaderActions\CreateHeaderAction;
use Illuminate\Database\Eloquent\Builder;

class CustomerCarTypeTable extends TableAbstract
{
    public function setup(): void
    {
        $this
            ->model(CustomerCarType::class)
            ->addHeaderAction(CreateHeaderAction::make()->route('car-rentals.customer-car-types.create'))
            ->addActions([
                EditAction::make()->route('car-rentals.customer-car-types.edit'),
                DeleteAction::make()->route('car-rentals.customer-car-types.destroy'),
            ])
            ->addColumns([
                IdColumn::make(),
                NameColumn::make()->route('car-rentals.customer-car-types.edit'),
                StatusColumn::make(),
                CreatedAtColumn::make(),
            ])
            ->addBulkActions([
                DeleteBulkAction::make()->permission('car-rentals.customer-car-types.destroy'),
            ])
            ->queryUsing(function (Builder $query): void {
                $query->select([
                    'id',
                    'name',
                    'slug',
                    'status',
                    'created_at',
                ]);
            });
    }
}
