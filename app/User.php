<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Roles;
use App\Comments;
class User extends Authenticatable
{
    public function roles()
    {
        return $this->belongsToMany('App\Roles','user_roles','user_id','role_id');
    }
    public function hasRole($role)
    {
        if ($this->roles()->where('name' , $role)->first()) {
            return true;
        }
        return false;
    }
    public function hasAnyRole($roles)
    {
        if (is_array($roles)) 
        {
            foreach ($roles as $role) 
            {
                if ($this->hasRole($role)) 
                {
                    return true;
                }
            }
        }
        else
        {
            if ($this->hasRole($roles)) 
            {
                return true;
            }
        }
    }
    public function likes()
    {
        // Maybe gives ana error because i remove post_id
        return $this->hasMany('App\Likes');
    } 
    public function comments()
    {
        // Maybe gives ana error because i remove post_id
        return $this->hasMany('App\Comments');
    } 
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
