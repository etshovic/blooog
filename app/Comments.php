<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Posts;
use App\User;
class Comments extends Model
{
    protected $fillable =  [
    	'body' , 'post_id'
    ];
    public function posts()
    {
    	return $this->belongsTo('App\Posts');
    }
    public function users()
    {
    	return $this->belongsTo('App\User');
    }
}
