<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Line extends UserModel
{
    use HasFactory;

    public static function booted(): void
    {
        static::creating(function($model){
            $model->slug = Str::uuid();
        });
        parent::booted();
    }
}
