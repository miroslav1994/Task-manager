<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResponsibleUser extends Model
{
    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function user_type() {
        return $this->belongsTo('App\UserType', 'user_type_id');
    }

    public function application() {
        return $this->hasMany('App\Application');
    }
}
