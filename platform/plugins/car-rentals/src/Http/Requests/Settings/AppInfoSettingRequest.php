<?php

namespace Botble\CarRentals\Http\Requests\Settings;

use Botble\Base\Rules\OnOffRule;
use Botble\Support\Http\Requests\Request;
use Illuminate\Validation\Rule;

class AppInfoSettingRequest extends Request
{
    public function rules(): array
    {
        return [
            'app_name' => ['required', 'string', 'max:255'],
            'app_email' => ['required', 'email', 'max:255'],
            'app_phone' => ['nullable', 'string', 'regex:/^[\+]?[0-9]{10,15}$/'],
        ];
    }
}
