<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends UserModel
{
    use HasFactory;

    public function tags(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(PageTag::class);
    }
    public function pageTag(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(PageTag::class);
    }
    public function customFieldValue(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(PageCustomFieldValue::class);
    }
}
