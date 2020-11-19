<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    public function user() {
        return $this->hasMany('App\User');
    }

    public function task() 
    {
        return $this->hasOne('App\Tasks');
    }
}
