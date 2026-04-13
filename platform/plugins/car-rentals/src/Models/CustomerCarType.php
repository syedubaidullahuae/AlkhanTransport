<?php

namespace Botble\CarRentals\Models;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Models\BaseModel;
use Botble\CarRentals\Models\Concerns\HasActiveCarsRelation;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CustomerCarType extends BaseModel
{
    use HasActiveCarsRelation;

    protected $table = 'customer_car_type';

    protected $fillable = [
        'name',
        'slug',
        'status',
    ];

    protected $casts = [
        'status' => BaseStatusEnum::class,
    ];
}
