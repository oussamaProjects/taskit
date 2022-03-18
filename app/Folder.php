<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Overtrue\LaravelFavorite\Traits\Favoriteable;

class Folder extends Model
{

    protected $fillable = ['name'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }


    public function department()
    {
        return $this->belongsToMany('App\Department', 'folder_departement', 'folder_id', 'department_id')->withPivot('permission_for');
    }

    public function children()
    {
        return $this->hasMany('App\Folder', 'parent_id', 'id');
    }
}