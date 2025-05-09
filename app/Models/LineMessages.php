<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LineMessages extends Model
{
    use HasFactory;

    public function line(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Line::class);
    }
    public function member(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Member::class,"member_line_id","line_id");
    }

    public function scopeUser($query)
    {
        return $query->where("user_id",auth()?->user()?->id);
    }
}
