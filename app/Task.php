<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable=[
        'name','start_time','end_time','estimate_time','active'
    ];

    public function categorys(){
        return $this->belongsToMany(Category::class,'tasks_category','task_id','category_id');
    }
    public function projects(){
        return $this->belongsToMany(Project::class,'tasks_projects','task_id','project_id');
    }

    public function users(){
        return $this->belongsToMany(User::class,'tasks_users','task_id','user_id');
    }

    public function times(){
        return $this->hasMany(Time::class);
    }
}
