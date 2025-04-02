<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageTagCustomField extends UserModel
{
    use HasFactory;

    public $attributes = [
        "sort" => 1,
        "type" => "text",
    ];
    public $casts = [
//        "options" => "array",
    ];
    public function pageTag(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(PageTag::class);
    }
}
