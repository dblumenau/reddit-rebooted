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
Route::get('/', function () {
	return view('welcome');
});
Route::post('/concerta', 'SlackController@concerta');
Route::post('/change-status', 'SlackController@postChangeStatus');
Route::get('/change-status', 'SlackController@getChangeStatus');
/*
 * Reddit
 */
Route::get('/reddit', 'RedditController@store');

//Route::get('/', function(){return view('layouts.home');});
//Route::resource('flyers', 'FlyersController');
//
//Route::get('/zz', 'TasksController@index');
//Route::get('/', 'PostsController@index')->name('home');
//Route::get('/posts/create', 'PostsController@create');
//Route::post('/posts', 'PostsController@store');
//Route::get('/posts/{post}', 'PostsController@show');
//
//Route::get('/posts/tags/{tag}', 'TagsController@index');
//
//Route::post('/posts/{post}/comments', 'CommentsController@store');
//
//Route::get('register', 'RegistrationController@create');
//Route::post('register', 'RegistrationController@store');
//Route::get('login', 'SessionsController@create')->name('login');
//Route::post('login' , 'SessionsController@store');
//Route::get('logout', 'SessionsController@destroy');