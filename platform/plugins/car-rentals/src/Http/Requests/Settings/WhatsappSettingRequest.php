<?php

namespace Botble\CarRentals\Http\Requests\Settings;

use Botble\Base\Rules\OnOffRule;
use Botble\Support\Http\Requests\Request;
use Illuminate\Validation\Rule;

class WhatsappSettingRequest extends Request
{
    public function rules(): array
    {
        return [
            'whatsapp_enable' => new OnOffRule(),
            'whatsapp_number' => ['nullable', 'string', 'regex:/^[\+]?[0-9]{10,15}$/'],
            'whatsapp_message' => ['nullable', 'string', 'max:200'],
        ];
    }
}
