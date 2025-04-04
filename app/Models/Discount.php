<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discount extends UserModel
{
    protected $casts = [
        "discount_start" => "datetime",
        "discount_end" => "datetime",
    ];
    //
    public function levels(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Level::class,PivotDiscountLevel::class);
    }
    public function level(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Level::class);
    }
}
