<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageCustomFieldValue extends UserModel
{
    use HasFactory;

    public function customField(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(PageTagCustomField::class);
    }
    public function page(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Page::class);
    }
}
