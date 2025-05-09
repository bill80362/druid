<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    public static function booted(): void
    {
        static::creating(function($model){
            if(!$model->user_id){
                $model->user_id = auth()?->user()?->id;
            }

        });
        static::updating(function($model){
            if(!$model->user_id){
                $model->user_id = auth()?->user()?->id;
            }
        });
        parent::booted();
    }
    public function scopeUser($query)
    {
        return $query->where("user_id",auth()?->user()?->id);
    }
}
