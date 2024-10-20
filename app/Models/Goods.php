<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    use HasFactory;

    public function specs(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Spec::class);
    }
    public function goodsDetails(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(GoodsDetail::class);
    }
}
