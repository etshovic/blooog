<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Roles;
use App\Settings;
class RegisterationController extends Controller
{
	public function create()
	{
        $disable_register =  Settings::where('name' , 'disable_register')->value('value');		
		return view('register' , compact('disable_register'));
	}
	public function store(Request $request)
	{
		// Create User
		$user = new User();
		$user->name = request('name');
		$user->email = request('email');
		$user->password = bcrypt(request('password'));
		$user->save();
		// Add Role to User
		$user->roles()->attach(Roles::where('name','User')->first()); 
		// Login 
		auth()->login($user);
		// redirect
		return redirect('posts');
	}
}
