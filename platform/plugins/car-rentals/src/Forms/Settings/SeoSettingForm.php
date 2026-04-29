<?php

namespace Botble\CarRentals\Forms\Settings;

use Botble\Base\Forms\FieldOptions\RadioFieldOption;
use Botble\Base\Forms\Fields\RadioField;
use Botble\CarRentals\Http\Requests\Settings\SeoSettingRequest;
use Botble\Setting\Forms\SettingForm;

class SeoSettingForm extends SettingForm
{
    public function setup(): void
    {
        parent::setup();

        $this
            ->setValidatorClass(SeoSettingRequest::class)
            ->setSectionTitle('Seo Settings')
            ->setSectionDescription('Configure SEO settings for your application')
            ->contentOnly()
            ->add(
                'seo_global_robots',
                RadioField::class,
                RadioFieldOption::make()
                    ->label('Search Engine Indexing')
                    ->choices([
                        'index' => 'Index',
                        'noindex' => 'No Index',
                    ])
                    ->selected(setting('car_rentals_seo_global_robots', 'index'))
            );
    }
}