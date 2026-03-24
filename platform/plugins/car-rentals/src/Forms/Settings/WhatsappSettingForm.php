<?php

namespace Botble\CarRentals\Forms\Settings;

use Botble\Base\Forms\FieldOptions\OnOffFieldOption;
use Botble\Base\Forms\Fields\TextField;
use Botble\Base\Forms\Fields\TextareaField;
use Botble\Base\Forms\Fields\OnOffCheckboxField;
use Botble\Base\Forms\FieldOptions\TextFieldOption;
use Botble\Base\Forms\FieldOptions\TextareaFieldOption;
use Botble\CarRentals\Http\Requests\Settings\WhatsappSettingRequest;
use Botble\Setting\Forms\SettingForm;

class WhatsappSettingForm extends SettingForm
{
    public function setup(): void
    {
        parent::setup();
        $this
            ->setValidatorClass(WhatsappSettingRequest::class)
            ->setSectionTitle('WhatsApp Booking Settings')
            ->setSectionDescription('Configure WhatsApp number and message')
            ->contentOnly()

            // Enable / Disable
            ->add(
                'whatsapp_enable',
                OnOffCheckboxField::class,
                OnOffFieldOption::make()
                    ->label('Enable WhatsApp Booking')
                    ->value(setting('car_rentals_whatsapp_enable', 1))
            )

            // WhatsApp Number
            ->add(
                'whatsapp_number',
                TextField::class,
                TextFieldOption::make()
                    ->label('WhatsApp Number')
                    ->value(setting('car_rentals_whatsapp_number'))
                    ->placeholder('e.g. 971501234567')
            )

            // Message Template
            ->add(
                'whatsapp_message',
                TextareaField::class,
                TextareaFieldOption::make()
                    ->label('Default Message')
                    ->value(setting('car_rentals_whatsapp_message'))
                    ->placeholder('Hello, I am interested in {{car_name}}')
                    ->helperText('Available: {{car_name}}, {{price}}, {{url}}')
            );

       
    }
}
