<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends UserModel
{
    protected $casts = [
        "discount_start" => "datetime",
        "discount_end" => "datetime",
    ];

    public function orders(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Order::class);
    }
}
