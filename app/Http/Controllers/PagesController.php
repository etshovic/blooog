<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Posts;
use App\Comments;
use App\User;
use App\Categories;
use App\Roles;
use App\Likes;
use App\Settings;
use Auth;
class PagesController extends Controller
{
    //
    public function statistics()
    {
        $users = User::count();
        $posts = Posts::count();
        $comments = Comments::count();
################################################################################
        // User1 Most Comments 
        $most_comments = User::withCount('comments')->orderBy('comments_count' , 'desc')->first();
        $likes_count_1 = Likes::where('user_id' , $most_comments->id)->count();
        $user_1_count = $most_comments->comments_count + $likes_count_1;
        // User1 Most Comments 
        
        // User2 Most likes 
        $most_likes = User::withCount('likes')->orderBy('likes_count' , 'desc')->first(); 
        $comments_count_2 = Comments::where('user_id' , $most_likes->id)->count();
        $user_2_count = $most_likes->likes_count + $comments_count_2;
        // User2 Most likes 
        
        if ($user_1_count > $user_2_count) {
            $active_user = $most_comments->name;
            $active_user_comments = $most_comments->comments_count;
            $active_user_likes = $likes_count_1;
        }
        else
        {
            $active_user = $most_likes->name;
            $active_user_likes = $most_likes->likes_count;
            $active_user_comments = $comments_count_2;
        }
################################################################################
        // Post1 Most Comments 
        $most_comments = Posts::withCount('comments')->orderBy('comments_count' , 'desc')->first();
        $likes_count_1 = Likes::where('post_id' , $most_comments->id)->count();
        $post_1_count = $most_comments->comments_count + $likes_count_1;
        // Post1 Most Comments 
        
        // Post2 Most Likes
        $most_likes = Posts::withCount('likes')->orderBy('likes_count' , 'desc')->first(); 
        $comments_count_2 = Comments::where('post_id' , $most_likes->id)->count();
        $post_2_count = $most_likes->likes_count + $comments_count_2;
        // Post2 Most Likes 
        
        if ($post_1_count > $post_2_count) {
            $active_post = $most_comments->title;
            $active_post_comments = $most_comments->comments_count;
            $active_post_likes = $likes_count_1;
        }
        else
        {
            $active_post = $most_likes->title;
            $active_post_likes = $most_likes->likes_count;
            $active_post_comments = $comments_count_2;
        }

        // dd($most_comments);

        $stats = [
            'users' => $users, 
            'posts' => $posts, 
            'comments' => $comments, 
            'active_user' => $active_user ,
            'active_user_likes' => $active_user_likes ,
            'active_user_comments' => $active_user_comments ,
            'active_post' => $active_post ,
            'active_post_likes' => $active_post_likes ,
            'active_post_comments' => $active_post_comments ,
        ];
 
        return view('content.statistics' , compact('stats'));
    }
    ###################################################################
    public function posts()
    {
        
        $posts = Posts::all();
        return view('content.posts' , compact('posts'));
    }
    public function post(Posts $post)
    {
        $disable_commenting =  Settings::where('name' , 'disable_comment')->value('value');
        return view('content.post' , compact('post' , 'disable_commenting' , 'disable_registering'));
    }
    public function store(Request $request)
    {
        $this->validate(request() , [
            'title' => 'required' ,
            'body' => 'required' ,
            'url' => 'image|mimes:jpg,jpeg,png,gif|max:2048' ,
        ]);
        $img_name = time() . '.' . $request->url->getClientOriginalExtension();

        $insert = new Posts();
        $insert->title = $request->title; // or request('title')
        $insert->body = $request->body; // or request('body')
        $insert->url = $img_name; // or request('body')
        $insert->save();

        $request->url->move(public_path('uploads') , $img_name);
        return redirect('/posts');
    }
    ###################################################################
    public function categories($name)
    {
        $category = Categories::where('name' , $name)->value('id');
        $posts = Posts::where('category_id' , $category)->get();
        return view('content.categories' , compact('posts'));
    }
    ###################################################################
    public function admin()
    {
        $users = User::all();
        $disable_comment =  Settings::where('name' , 'disable_comment')->value('value');
        $disable_register =  Settings::where('name' , 'disable_register')->value('value');
        return view('content.admin' , compact("users" , 'disable_comment' , 'disable_register'));
    }
    public function settings(Request $request)
    {
        if ($request->disable_commenting) {
            Settings::where('name' , 'disable_comment')->update(['value' => 1]);
        }
        else
        {
            Settings::where('name' , 'disable_comment')->update(['value' => 0]);
        }

        if ($request->disable_registering) {
            Settings::where('name' , 'disable_register')->update(['value' => 1]);
        }
        else
        {
            Settings::where('name' , 'disable_register')->update(['value' => 0]);
        }

        return redirect()->back();
    }
    public function editor()
    {
        return view('content.editor');
    }
    public function add_role(Request $request)
    {
        $user = User::where('email' , $request['email'])->first();
        $user->roles()->detach();
        if ($request['admin']) {
            $user->roles()->attach(Roles::where('name' , 'Admin')->first());
        }
        if ($request['editor']) {
            $user->roles()->attach(Roles::where('name' , 'Editor')->first());
        }
        if ($request['user']) {
            $user->roles()->attach(Roles::where('name' , 'User')->first());
        }
        return redirect()->back();
    }
    public function access_denied()
    {
        return view('content.access_denied');
    }
    public function like(Request $request)
    {
        $like_s = $request->like_s;
        $post_id = $request->post_id;
        $change_like = 0;
        $change_unlike = 0;

        $like = Likes::where('post_id' , $post_id)
        ->where('user_id' , \Auth::user()->id)
        ->first();
        if (!$like) {
            $new_like = new Likes();
            $new_like->like = 1;
            $new_like->post_id = $post_id;
            $new_like->user_id = Auth::user()->id;
            $new_like->save();
            $is_like = 1 ; 
        }
        elseif ($like->like == 1) {
            Likes::where('post_id' , $post_id)->where('user_id' , Auth::user()->id)->delete();
            $is_like = 0 ; 
        }
        elseif ($like->like == 0) {
            Likes::where('post_id' , $post_id)->where('user_id' , Auth::user()->id)->update([
                'like' => 1
            ]);
            $is_like = 1 ; 
            $change_like = 1 ; 
        }
        $response = [
            'is_like' => $is_like ,
            'change_like' => $change_like 

        ]; 
        return response()->json($response , 200);
    }
    public function unlike(Request $request)
    {
        $like_s = $request->like_s;
        $post_id = $request->post_id;
        $unlike = Likes::where('post_id' , $post_id)
        ->where('user_id' , \Auth::user()->id)
        ->first();
        if (!$unlike) {
            $new_like = new Likes();
            $new_like->like = 0;
            $new_like->post_id = $post_id;
            $new_like->user_id = Auth::user()->id;
            $new_like->save();
            $is_unlike = 1 ; 
        }
        elseif ($unlike->like == 0) {
            Likes::where('post_id' , $post_id)->where('user_id' , Auth::user()->id)->delete();
            $is_unlike = 0 ; 
        }
        elseif ($unlike->like == 1) {
            Likes::where('post_id' , $post_id)->where('user_id' , Auth::user()->id)->update([
                'like' => 0
            ]);
            $is_unlike = 1 ; 
            $change_unlike = 1;                        
        }
        $response = [
            'is_unlike' => $is_unlike , 
            'change_unlike' => $change_unlike  
        ]; 
        return response()->json($response , 200);
    }
}
