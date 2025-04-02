<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetaMessage extends UserModel
{
    use HasFactory;

    public function meta(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Meta::class);
    }
    public function member(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Member::class,"member_meta_id","meta_id");
    }

}
