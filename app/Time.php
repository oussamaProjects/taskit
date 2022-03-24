<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
  protected  $fillable=['task_id' , 'start_time' , 'end_time' , 'estimate_time'];

  public function tasks(){
      return $this->belongsTo(Task::class ,'task_id' ,'id');
  }
}
