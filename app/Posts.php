<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Comments;
use App\Likes;
class Posts extends Model
{
    //
    protected $fillable =  [
    	'title' ,
        'body' ,
    	'category_id' ,
    ];
    public function comments()
    {
        return $this->hasMany('App\Comments', 'post_id')->orderBy('created_at');
    }  
    public function likes()
    {
    	return $this->hasMany('App\Likes', 'post_id');
    }    
    public function category()
    {
    	return $this->belongsTo('App\Categories');
    }
}
