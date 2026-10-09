<?php

namespace Botble\CarRentals\Tables;

use Botble\Base\Facades\Html;
use Botble\CarRentals\Enums\CarPurposeEnum;
use Botble\CarRentals\Enums\CarStatusEnum;
use Botble\CarRentals\Enums\ModerationStatusEnum;
use Botble\CarRentals\Facades\CarRentalsHelper;
use Botble\CarRentals\Models\Car;
use Botble\CarRentals\Models\CarMake;
use Botble\CarRentals\Tables\BulkActions\CloneCarsBulkAction;
use Botble\Location\Models\City;
use Botble\Location\Models\Country;
use Botble\Location\Models\State;
use Botble\Table\Abstracts\TableAbstract;
use Botble\Table\Actions\DeleteAction;
use Botble\Table\Actions\EditAction;
use Botble\Table\BulkActions\DeleteBulkAction;
use Botble\Table\Columns\CreatedAtColumn;
use Botble\Table\Columns\FormattedColumn;
use Botble\Table\Columns\IdColumn;
use Botble\Table\Columns\NameColumn;
use Botble\Table\Columns\StatusColumn;
use Botble\Table\HeaderActions\CreateHeaderAction;
use Illuminate\Database\Eloquent\Builder;

class CarTable extends TableAbstract
{
    public function setup(): void
    {
        $this
            ->model(Car::class)
            ->addHeaderAction(CreateHeaderAction::make()->route('car-rentals.cars.create'))
            ->addActions([
                EditAction::make()->route('car-rentals.cars.edit'),
                DeleteAction::make()->route('car-rentals.cars.destroy'),
            ])
            ->addColumns(function () {
                $columns = [
                    IdColumn::make(),
                    NameColumn::make()->route('car-rentals.cars.edit'),
                    FormattedColumn::make('license_plate')
                        ->title(trans('plugins/car-rentals::car-rentals.car.forms.license_plate'))
                        ->withEmptyState(),
                    FormattedColumn::make('make')
                        ->title(trans('plugins/car-rentals::car-rentals.car.forms.make'))
                        ->getValueUsing(function (FormattedColumn $column) {
                            return $column->getItem()->make?->name;
                        })
                        ->withEmptyState()
                        ->orderable(false)
                        ->searchable(false),
                    FormattedColumn::make('year')
                        ->title(trans('plugins/car-rentals::car-rentals.car.forms.year'))
                        ->withEmptyState(),
                    FormattedColumn::make('car_purpose')
                        ->title(trans('plugins/car-rentals::car-rentals.car.forms.car_purpose'))
                        ->renderUsing(function (FormattedColumn $column) {
                            $purpose = $column->getItem()->car_purpose;

                            return (new CarPurposeEnum())->make($purpose)->toHtml();
                        })
                        ->orderable(false)
                        ->searchable(false),
                    FormattedColumn::make('rental_rate')
                        ->title(trans('plugins/car-rentals::car-rentals.car.forms.rental_rate'))
                        ->renderUsing(function (FormattedColumn $column) {
                            $car = $column->getItem();

                            return Html::tag('strong', format_price_in_default_currency($car->rental_rate, $car->currency_id));
                        }),
                    StatusColumn::make('status'),
                    CreatedAtColumn::make(),
                ];

                if (CarRentalsHelper::isEnabledPostApproval()) {
                    $columns[] = FormattedColumn::make('moderation_status')
                        ->title(trans('plugins/car-rentals::car-rentals.car.forms.moderation_status'))
                        ->width(150)
                        ->renderUsing(function (FormattedColumn $column) {
                            return $column->getItem()->moderation_status->toHtml();
                        });
                }

                return $columns;
            })
            ->addBulkActions([
                CloneCarsBulkAction::make()->permission('car-rentals.cars.create'),
                DeleteBulkAction::make()->permission('car-rentals.cars.destroy'),
            ])
            ->onFilterQuery(function (Builder $query, string $key, string $operator, ?string $value) {
                if ($key !== 'car_purpose') {
                    return null;
                }

                if (! in_array($value, [CarPurposeEnum::FOR_SALE, CarPurposeEnum::FOR_RENT], true)) {
                    return $query->whereRaw('1 = 0');
                }

                return $query->where('is_for_sale', $value === CarPurposeEnum::FOR_SALE);
            })
            ->queryUsing(function (Builder $query): void {
                $query
                    ->select([
                        'id',
                        'license_plate',
                        'make_id',
                        'name',
                        'year',
                        'mileage',
                        'rental_rate',
                        'sale_price',
                        'currency_id',
                        'insurance_info',
                        'status',
                        'moderation_status',
                        'reject_reason',
                        'created_at',
                        'is_for_sale',
                    ])
                    ->with('make');
            });
    }

    public function getFilters(): array
    {
        $filters = [
            'name' => [
                'title' => trans('core/base::tables.name'),
                'type' => 'text',
            ],
            'license_plate' => [
                'title' => trans('plugins/car-rentals::car-rentals.car.forms.license_plate'),
                'type' => 'text',
            ],
            'make_id' => [
                'title' => trans('plugins/car-rentals::car-rentals.car.forms.make'),
                'type' => 'select',
                'choices' => ['' => trans('core/base::tables.all')] + CarMake::query()->orderBy('name')->pluck('name', 'id')->all(),
            ],
            'country_id' => [
                'title' => trans('plugins/location::city.country'),
                'type' => 'select-search',
                'choices' => ['' => trans('core/base::tables.all')] + Country::query()->orderBy('name')->pluck('name', 'id')->all(),
            ],
            'state_id' => [
                'title' => trans('plugins/location::city.state'),
                'type' => 'select-search',
                'choices' => ['' => trans('core/base::tables.all')] + State::query()->orderBy('name')->pluck('name', 'id')->all(),
            ],
            'city_id' => [
                'title' => trans('plugins/location::city.city'),
                'type' => 'select-search',
                'choices' => ['' => trans('core/base::tables.all')] + City::query()->orderBy('name')->pluck('name', 'id')->all(),
            ],
            'year' => [
                'title' => trans('plugins/car-rentals::car-rentals.car.forms.year'),
                'type' => 'number',
            ],
            'car_purpose' => [
                'title' => trans('plugins/car-rentals::car-rentals.car.forms.car_purpose'),
                'type' => 'select',
                'choices' => ['' => trans('core/base::tables.all')] + CarPurposeEnum::labels(),
            ],
            'status' => [
                'title' => trans('core/base::tables.status'),
                'type' => 'select',
                'choices' => ['' => trans('core/base::tables.all')] + CarStatusEnum::labels(),
            ],
        ];

        if (CarRentalsHelper::isEnabledPostApproval()) {
            $filters['moderation_status'] = [
                'title' => trans('plugins/car-rentals::car-rentals.car.forms.moderation_status'),
                'type' => 'select',
                'choices' => ['' => trans('core/base::tables.all')] + ModerationStatusEnum::labels(),
            ];
        }

        return $filters;
    }
}
