<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use JetBrains\PhpStorm\ArrayShape;

class ShoppingCart extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'data' => 'json',
        ];
    }
}
