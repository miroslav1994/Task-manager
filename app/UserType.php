<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    public function responsible_users() {
        return $this->hasMany('App\ResponsibleUser');
    }
}
