<?php

namespace Botble\CarImport\Forms;

use Botble\Base\Forms\Fields\FileField;
use Botble\Base\Forms\FieldOptions\FileFieldOption;
use Botble\Base\Forms\FormAbstract;
use Botble\CarImport\Http\Requests\ImportRequest;

class ImportForm extends FormAbstract
{
    public function setup(): void
    {
        $this
            ->setValidatorClass(ImportRequest::class)
            ->setFormOption('files', true) 
            ->add(
                'csv_file',
                FileField::class,
                FileFieldOption::make()
                    ->label('CSV File')
                    ->required()
                    ->helperText('Upload CSV file to import cars.')
            );
           
    }
}