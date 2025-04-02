<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageTag extends UserModel
{
    use HasFactory;

    public function pages(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Page::class);
    }
    public function customFields(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(PageTagCustomField::class);
    }
}
