<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Point extends UserModel
{
    public function member(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Member::class);
    }
    public function order(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
    public function discount(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Discount::class);
    }
}
