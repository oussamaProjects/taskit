<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'name', 'description', 'estimate_time', 'estimate_value', 'client_id','color'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'user_id', 'id');
    }
    public function tasks()
    {
        return $this->belongsToMany(Task::class, 'tasks_projects', 'project_id', 'task_id');
    }

    public function departments(){
        return $this->belongsToMany(Department::class,'departments_projects','project_id','department_id');
    }
}
