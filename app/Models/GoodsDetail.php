<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoodsDetail extends Model
{
    use HasFactory;

    public function specs(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Spec::class,GoodsDetailSpecOption::class)->withPivot("spec_option_id");
    }
    public function specOptions(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(SpecOption::class,GoodsDetailSpecOption::class)->withPivot("spec_id");
    }

}
