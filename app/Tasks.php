<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    public function companies() 
    {
        return $this->belongsTo('App\Company', 'company_id');
    }

    public function users() 
    {
        return $this->belongsTo('App\User', 'created_by');
    }

    public function statuses()
    {
        return $this->belongsTo('App\Status', 'status_id');
    }

    public function applications()
    {
        return $this->belongsTo('App\Application', 'application_id');
    }

    public function responsible_users()
    {
        return $this->belongsTo('App\ResponsibleUser', 'responsible_user_id');
    }

    public function responsible_implementer_users()
    {
        return $this->belongsTo('App\ResponsibleUser', 'responsible_user_implementer_id');
    }

    public function task_types() 
    {
        return $this->belongsTo('App\TaskType', 'task_types_id');
    }

    
}
