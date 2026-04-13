<?php

namespace Botble\CarRentals\Models;

use Botble\ACL\Models\User;
use Botble\Base\Casts\SafeContent;
use Botble\Base\Models\BaseModel;
use Botble\CarRentals\Enums\CustomerStatusEnum;
use Botble\Base\Supports\Avatar;
use Botble\CarRentals\Notifications\ConfirmEmailNotification;
use Botble\CarRentals\Notifications\ResetPasswordNotification;
use Botble\Media\Facades\RvMedia;
use Exception;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CustomerVehicleType extends BaseModel
{

    protected $table = 'customer_vehicle_types';

    protected $fillable = [
        'customer_id',
        'vehicle_type_id',
    ];


    public function customers()
    {
        return $this->belongsToMany(
            Customer::class,
            'customer_vehicle_types',
            'vehicle_type_id',
            'customer_id'
        );
    }

    
}
