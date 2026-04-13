<?php

namespace Botble\CarRentals\Forms;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Forms\FieldOptions\CoreIconFieldOption;
use Botble\Base\Forms\FieldOptions\NameFieldOption;
use Botble\Base\Forms\FieldOptions\SortOrderFieldOption;
use Botble\Base\Forms\FieldOptions\StatusFieldOption;
use Botble\Base\Forms\Fields\CoreIconField;
use Botble\Base\Forms\Fields\MediaImageField;
use Botble\Base\Forms\Fields\NumberField;
use Botble\Base\Forms\Fields\SelectField;
use Botble\Base\Forms\Fields\TextField;
use Botble\Base\Forms\FormAbstract;
use Botble\CarRentals\Http\Requests\CustomerCarTypeRequest;
use Botble\CarRentals\Models\CustomerCarType;

class CustomerCarTypeForm extends FormAbstract
{
    public function setup(): void
    {
        $this
            ->model(CustomerCarType::class)
            ->setValidatorClass(CustomerCarTypeRequest::class)
            ->add(
                'name',
                TextField::class,
                NameFieldOption::make()
                    ->required()
                    ->maxLength(120)
            )
            ->add('status', SelectField::class, StatusFieldOption::make()->choices(BaseStatusEnum::labels()))
            ->setBreakFieldPoint('status');
    }
}
