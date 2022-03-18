<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subsidiary extends Model
{

    protected $fillable = ['susbsName'];

    public function users()
    {
        return $this->hasMany('App\User');
    }

    public function folders()
    {
        return $this->belongsToMany('App\folder', 'folder_departement', 'department_id', 'folder_id');
    }

    public function departments()
    {
        return $this->belongsToMany('App\Department', 'subsidiaries_departement', 'subs_id', 'departement_id');
    }

}
