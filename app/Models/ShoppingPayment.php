<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShoppingPayment extends Model
{
    //
    public function payment(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Payment::class);
    }
}
