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
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table='users';

    protected $fillable = [
        'name', 'email', 'password','role','price','action'
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

    public function tasks() {
        return $this->belongsToMany(Task::class,'tasks_users','user_id','task_id');
    }
    public function groups(){
        return $this->BelongsToMany(Group::class,'users_groups','user_id','group_id');
    }

}
