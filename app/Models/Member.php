<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    public static function booted(): void
    {
        static::creating(function($model){
            $model->slug = rand(1000000000,9999999999);
            if(!$model->level_id) $model->level_id = Level::orderBy("sort")->first()->id;
        });
    }
    public function level(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Level::class);
    }
    public function points(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Point::class);
    }
}
