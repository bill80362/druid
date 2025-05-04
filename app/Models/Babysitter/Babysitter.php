<?php

namespace App\Models\Babysitter;

use App\Models\PivotDiscountLevel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Babysitter extends Model
{
    public static function booted(): void
    {
        static::creating(function($model){
            $model->slug = Str::uuid();
        });
        parent::booted();
    }

    public function services(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(BabysitterService::class, PivotDiscountLevel::class);
    }
}
