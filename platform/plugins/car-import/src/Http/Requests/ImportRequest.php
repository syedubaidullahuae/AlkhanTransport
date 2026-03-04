<?php

namespace Botble\CarImport\Http\Requests;

use Botble\Support\Http\Requests\Request;

class ImportRequest extends Request
{
    public function rules(): array
    {
        return [
            'csv_file' => 'required|mimes:csv,txt',
        ];
    }
}