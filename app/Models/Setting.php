<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends UserModel
{
    //
    protected $casts = [
        "content" => "json",
    ];
}
