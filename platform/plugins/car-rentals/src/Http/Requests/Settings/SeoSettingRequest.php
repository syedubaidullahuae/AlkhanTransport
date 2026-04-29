<?php

namespace Botble\CarRentals\Http\Requests\Settings;

use Botble\Base\Rules\OnOffRule;
use Botble\Support\Http\Requests\Request;
use Illuminate\Validation\Rule;

class SeoSettingRequest extends Request
{
    public function rules(): array
    {
        return [
            'seo_global_robots' => ['required', Rule::in(['index', 'noindex'])],
        ];
    }
}
