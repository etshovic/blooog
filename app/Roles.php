<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
class Roles extends Model
{
    public function users()
    {
        return $this->belongsToMany('App\User','user_roles','role_id','user_id');
    }
}
