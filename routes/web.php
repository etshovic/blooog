<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('access_denied' , 'PagesController@access_denied');
Route::get('statistics' , 'PagesController@statistics');
########################### Admin Routes ###########################
Route::group(['middleware' => 'roles_check' ,'roles' => 'admin' ], function () {
	Route::get('admin' , 'PagesController@admin');
	Route::post('admin/add-role' , 'PagesController@add_role');
	Route::post('settings' , 'PagesController@settings');
});
Route::group(['middleware' => 'roles_check' ,'roles' => ['admin' ,'editor'] ], function () {
	Route::get('editor' , 'PagesController@editor');
	Route::post('posts/store' , 'PagesController@store');

});
Route::group(['middleware' => 'roles_check' ,'roles' => ['admin' , 'editor' ,'user'] ], function () {

	Route::post('like' , 'PagesController@like')->name('like');
	Route::post('unlike' , 'PagesController@unlike')->name('unlike');
});
########################### Welcome Routes ###########################
Route::get('/', function () {
    return view('welcome');
});
########################### Posts Routes ##########################
Route::get('posts' , 'PagesController@posts');
Route::get('posts/{post}' , 'PagesController@post');
Route::post('posts/{post}/store' , 'CommentsController@store');
########################### Categories Routes #####################
Route::get('categories/{name}' , 'PagesController@categories');
########################### Auth Routes ###########################
Route::get('register' , 'RegisterationController@create');
Route::post('register' , 'RegisterationController@store');
########################### Login Routes ##########################
Route::get('login' , 'SessionsController@create');
Route::post('login' , 'SessionsController@store');
Route::get('logout' , 'SessionsController@logout');