<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    public function responsible_users() {
        return $this->belongsTo('App\ResponsibleUser', 'responsible_user_id');
    }

    public function implementers() {
        return $this->belongsTo('App\ResponsibleUser', 'implementer_id');
    }
}



