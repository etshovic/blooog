<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Posts;
use App\Comments;
class CommentsController extends Controller
{
    public function store(Posts $post)
    {
    	Comments::create([
    		'body' => request('body') ,
    		'post_id' => $post->id ,
    	]);
        return back();
    }
}
        // $this->validate(request() , [
        //     'body' => 'required' ,
        // ]);

        // $insert = new Comments();
        // $insert->body = $request->body; // or request('body')
        // $insert->save();


        // return redirect('/posts');
