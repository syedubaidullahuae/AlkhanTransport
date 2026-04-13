<?php

namespace Botble\CarRentals\Http\Requests;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Support\Http\Requests\Request;
use Illuminate\Validation\Rule;

class CustomerCarTypeRequest extends Request
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:120', 'min:2'],
            'status' => ['required', 'string', Rule::in(BaseStatusEnum::values())],
        ];
    }
}
