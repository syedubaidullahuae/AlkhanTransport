<?php

namespace Botble\CarRentals\Forms\Fronts\Auth;

use Botble\Base\Facades\Html;
use Botble\Base\Forms\FieldOptions\CheckboxFieldOption;
use Botble\Base\Forms\FieldOptions\HiddenFieldOption;
use Botble\Base\Forms\FieldOptions\HtmlFieldOption;
use Botble\Base\Forms\FieldOptions\MultiChecklistFieldOption;
use Botble\Base\Forms\FieldOptions\RadioFieldOption;
use Botble\Base\Forms\Fields\EmailField;
use Botble\Base\Forms\Fields\HiddenField;
use Botble\Base\Forms\Fields\HtmlField;
use Botble\Base\Forms\Fields\OnOffCheckboxField;
use Botble\Base\Forms\Fields\PasswordField;
use Botble\Base\Forms\Fields\PhoneNumberField;
use Botble\Base\Forms\Fields\RadioField;
use Botble\Base\Forms\Fields\TextField;
use Botble\CarRentals\Facades\CarRentalsHelper;
use Botble\CarRentals\Forms\Fronts\Auth\FieldOptions\EmailFieldOption;
use Botble\CarRentals\Forms\Fronts\Auth\FieldOptions\PhoneNumberFieldOption;
use Botble\CarRentals\Forms\Fronts\Auth\FieldOptions\TextFieldOption;
use Botble\CarRentals\Http\Requests\Fronts\Auth\RegisterRequest;
use Botble\CarRentals\Models\Customer;
use Botble\CarRentals\Models\CustomerCarType;
use Botble\Theme\Facades\Theme;

use Botble\Base\Forms\Fields\SelectField;
use Botble\Base\Forms\FieldOptions\SelectFieldOption;
use Botble\Base\Forms\Fields\MultiCheckListField;

class RegisterForm extends AuthForm
{
    public static function formTitle(): string
    {
        return __('Customer register form');
    }

    public function setup(): void
    {
        parent::setup();
        Theme::asset()->add('booking-css', 'vendor/core/plugins/car-rentals/css/front-booking-form.css', version: get_cms_version());
        Theme::asset()->container('footer')->add('booking-js', 'vendor/core/plugins/car-rentals/js/front-booking-form.js', version: get_cms_version());

        $this
            ->setUrl(route('customer.register.post'))
            ->setValidatorClass(RegisterRequest::class)
            ->icon('ti ti-user-plus')
            ->heading(__('Register an account'))
            ->description(__('Your personal data will be used to support your experience throughout this website, to manage access to your account.'))
            ->when(
                theme_option('register_background'),
                fn (AuthForm $form, string $background) => $form->banner($background)
            )
            ->add(
                'name',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Full name'))
                    ->placeholder(__('Your full name'))
                    ->icon('ti ti-user')
            )
            ->add(
                'email',
                EmailField::class,
                EmailFieldOption::make()
                    ->label(__('Email'))
                    ->required()
                    ->placeholder(__('Your email'))
                    ->icon('ti ti-mail')
                    ->addAttribute('autocomplete', 'email')
            )
            ->add(
                'phone',
                PhoneNumberField::class,
                PhoneNumberFieldOption::make()
                    ->label(__('Phone (optional)'))
                    ->placeholder(__('Phone number'))
                    ->withCountryCodeSelection()
                    ->addAttribute('autocomplete', 'tel')
            )
            ->add(
                'vehicles',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Vehicle Types'))
                    ->placeholder("Select vehicle types you want to rent")
                    ->icon('ti ti-car')
                    ->addAttribute('id', 'vehicles')
            )
            ->add(
                'vehicle_types_container',
                HtmlField::class,
                HtmlFieldOption::make()
                    ->content('<div id="vehicle_types_container"></div>')
            )
            // ->add(
            //     'vehicle_types[]',
            //     'hidden',
            //     TextFieldOption::make()
            //      ->addAttribute('id', 'vehicle_types')
            // )


            // ->add(
            //     'vehicle_types',
            //     SelectField::class,
            //     SelectFieldOption::make()
            //         ->label('Vehicle Types')
            //         ->choices(
            //             CustomerCarType::query()->wherePublished()->pluck('name', 'id')->all()
            //         )
            //         ->multiple()
            //         ->addAttribute('class', 'form-control select2')
            //         ->addAttribute('id', 'vehicle_types')
            // )
            
            ->add(
                'password',
                PasswordField::class,
                TextFieldOption::make()
                    ->label(__('Password'))
                    ->placeholder(__('Password'))
                    ->icon('ti ti-lock')
            )
            ->add(
                'password_confirmation',
                PasswordField::class,
                TextFieldOption::make()
                    ->label(__('Password confirmation'))
                    ->placeholder(__('Password confirmation'))
                    ->icon('ti ti-lock')
            )
            ->when(CarRentalsHelper::isMultiVendorEnabled(), function (RegisterForm $form): void {
                $form->add(
                    'is_vendor',
                    RadioField::class,
                    RadioFieldOption::make()
                        ->label(__('Register as'))
                        ->choices([0 => __('I am a customer'), 1 => __('I am a dealer/car owner')])
                        ->defaultValue(0)
                );
            })


            
            ->submitButton(__('Register'), 'ti ti-arrow-narrow-right')
            ->add(
                'login',
                HtmlField::class,
                HtmlFieldOption::make()
                    ->view('plugins/car-rentals::customers.includes.login-link')
            )
          
            ->add('filters', HtmlField::class, [
                'html' => apply_filters(BASE_FILTER_AFTER_LOGIN_OR_REGISTER_FORM, null, Customer::class),
            ]);
    }
}
