<?php
namespace Botble\CarRentals\Forms\Fronts\Customers;

use Botble\Base\Forms\FormAbstract;
use Botble\Base\Forms\Fields\PhoneNumberField;
use Botble\Base\Forms\FieldOptions\PhoneNumberFieldOption;

class PhoneBookinFrom extends FormAbstract
{
    public function buildForm(): void
    {
        $this
            ->add(
                'customer_phone',
                PhoneNumberField::class,
                PhoneNumberFieldOption::make()
                    ->label(false)
                    ->placeholder(__('Phone number'))
                    ->withCountryCodeSelection()
                    ->addAttribute('autocomplete', 'tel')
            );
    }
}