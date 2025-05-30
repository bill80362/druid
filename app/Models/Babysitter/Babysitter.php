<?php

namespace App\Models\Babysitter;

use App\Models\City;
use App\Models\PivotDiscountLevel;
use App\Models\Region;
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

    protected $casts = [
        'sign_at' => 'datetime',
    ];

    public function services(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(BabysitterService::class, PivotBabysitterService::class);
    }
    public function addressCity(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(City::class, 'city');
    }
    public function addressRegion(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Region::class, 'region');
    }
}
