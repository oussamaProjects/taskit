<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Overtrue\LaravelFavorite\Traits\Favoriteable;

class Document extends Model
{
    protected $table = 'document';

    protected $fillable = ['name', 'description'];
    
    // use Favoriteable;

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }

    public function folders()
    {
        return $this->belongsToMany('App\Folder');
    }

    public function department()
    {
        return $this->belongsToMany('App\Department', 'document_departement', 'document_id', 'department_id')->withPivot('permission_for');
    }
}