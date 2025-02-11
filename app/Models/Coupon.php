<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $casts = [
        "discount_start" => "datetime",
        "discount_end" => "datetime",
    ];
}
