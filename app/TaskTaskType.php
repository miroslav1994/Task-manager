<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskTaskType extends Model
{
    public function tasks_tasks_types()
    {
        return $this->hasMany('App\TaskType', 'task_task_type_id');
    }
    
}
