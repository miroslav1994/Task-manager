<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskItems extends Model
{
    public function users() 
    {
        return $this->belongsTo('App\User', 'createdBy');
    }
}
