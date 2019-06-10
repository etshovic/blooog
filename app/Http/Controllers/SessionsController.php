<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionsController extends Controller
{
	public function create()
	{
		return view('login');
	}	
	public function store(Request $request)
	{
		if (! auth()->attempt(request(['email' , 'password'])))
		{
			return back()->withErrors([
				'message' => 'Email Or Password are not CORRECT' ,
			]);
		}

		return redirect('posts');
	}
	public function logout()
	{
		auth()->logout();
		return redirect('posts');
	}
}
