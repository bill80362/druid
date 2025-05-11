<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public function regions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Region::class);
    }
}
