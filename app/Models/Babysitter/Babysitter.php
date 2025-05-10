<?php

namespace App\Models\Babysitter;

use App\Models\PivotDiscountLevel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Babysitter extends Model
{
    protected $attributes = [
        "status" => "Y",
        "apply_money" => "Y",
    ];
    public static function booted(): void
    {
        static::creating(function($model){
            $model->slug = Str::uuid();
        });
        parent::booted();
    }

    public function services(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(BabysitterService::class, PivotBabysitterService::class);
    }
}
