<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Overtrue\LaravelFavorite\Traits\Favoriter;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    use Favoriter;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'department_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    // public function department() {
    //     return $this->belongsTo('App\Department');
    // }

    public function departments()
    {
        return $this->belongsToMany('App\Department', 'user_departement', 'user_id', 'departement_id');
    }

    public function subsidiaries() {
        return $this->belongsTo('App\Subsidiary');
    }

    public function documents() {
        return $this->hasMany('App\Document');
    }

}
