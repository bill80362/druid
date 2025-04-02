<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecOption extends UserModel
{
    use HasFactory;

    public function spec(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Spec::class);
    }
}
