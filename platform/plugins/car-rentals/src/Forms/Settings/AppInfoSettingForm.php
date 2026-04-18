<?php

namespace Botble\CarRentals\Forms\Settings;

use Botble\Base\Forms\FieldOptions\OnOffFieldOption;
use Botble\Base\Forms\Fields\TextField;
use Botble\Base\Forms\Fields\TextareaField;
use Botble\Base\Forms\Fields\OnOffCheckboxField;
use Botble\Base\Forms\FieldOptions\TextFieldOption;
use Botble\Base\Forms\FieldOptions\TextareaFieldOption;
use Botble\CarRentals\Http\Requests\Settings\AppInfoSettingRequest;
use Botble\Setting\Forms\SettingForm;

class AppInfoSettingForm extends SettingForm
{
    public function setup(): void
    {
        parent::setup();

        $this
            ->setValidatorClass(AppInfoSettingRequest::class)
            ->setSectionTitle('App Info Settings')
            ->setSectionDescription('Configure application name, email, and phone')
            ->contentOnly()

            // App Name
            ->add(
                'app_name',
                TextField::class,
                TextFieldOption::make()
                    ->label('App Name')
                    ->value(setting('car_rentals_app_name'))
                    ->placeholder('Enter application name')
            )

            // Email
            ->add(
                'app_email',
                TextField::class,
                TextFieldOption::make()
                    ->label('Email')
                    ->value(setting('car_rentals_app_email'))
                    ->placeholder('Enter email address')
            )

            // Phone
            ->add(
                'app_phone',
                TextField::class,
                TextFieldOption::make()
                    ->label('Phone')
                    ->value(setting('car_rentals_app_phone'))
                    ->placeholder('Enter phone number')
            );
    }
}
