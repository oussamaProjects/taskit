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

  public function documents()
  {
    return $this->belongsToMany('App\Document', 'document_departement', 'department_id', 'document_id');
  }
}