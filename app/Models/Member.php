<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    public static function booted(): void
    {
        static::creating(fn($model) => $model->slug = rand(1000000000,9999999999));
    }

}
