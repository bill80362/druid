<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spec extends Model
{
    use HasFactory;

    public function specOptions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(SpecOption::class);
    }
}
