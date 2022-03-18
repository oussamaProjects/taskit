<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Group extends Model
{
   protected $fillable=[
       'name','color'
   ];

   public function users(){
       return $this->BelongsToMany(User::class,'users_groups','group_id','user_id');
   }
}
