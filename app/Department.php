<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
  protected $table = 'departments';

  protected $fillable = ['dptName'];

  public function users()
  {
    return $this->hasMany('App\User');
  }


  public function folders()
  {
    return $this->belongsToMany('App\folder', 'folder_departement', 'department_id', 'folder_id');
  }

  public function subsidiaries()
  {
    return $this->belongsToMany('App\Subsidiary', 'subsidiaries_departement', 'departement_id', 'subs_id');
  }

  public function projects()
  {
    return $this->belongsToMany(Project::class, 'departments_projects', 'department_id', 'project_id');
  }
}