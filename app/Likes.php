<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use App\Posts;

class Likes extends Model
{
    public function posts()
    {
    	return $this->belongsTo('App\Posts');
    }
    public function users()
    {
    	return $this->belongsTo('App\User');
    }
}
