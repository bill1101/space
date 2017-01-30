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

//Route::get('/', function () {
//    return view('welcome');
//});

//Route::get('auth/login',['as' =>'auth.login','uses'=>'Auth\LoginController@showLoginForm']);

Auth::routes();
//Route::get('/home', ['uses'=>'HomeController@index','as'=>'home']);
//Route::get('/home/{username}', ['uses'=>'HomeController@index','as'=>'home']);
Route::get('/', ['uses'=>'HomeController@index','as'=>'home']);
Route::get('/{id}', ['uses'=>'HomeController@indexUser','as'=>'otherhome']);

Route::post('/search',['uses'=>'SearchController@getResults','as'=>'search.results']);

Route::get('user/{username}',['uses'=>'ProfileController@getProfile','as'=>'profile.index']);
Route::get('/profile/edit',['uses'=>'ProfileController@getEdit','as'=>'profile.edit','middleware'=>['auth']]);
Route::post('/profile/edit',['uses'=>'ProfileController@postEdit','middleware'=>['auth']]);

//Route::get('/request',['uses'=>'FriendsController@getRequest','as'=>'friends.requests','middleware'=>['auth']]);
//Route::get('/request/{username}','FriendsController@getRequests');
Route::get('/friends/{username}',['uses'=>'FriendsController@getFriends','as'=>'friends.index']);
Route::get('/friends/add/{username}',['uses'=>'FriendsController@getAdd','as'=>'friends.add','middleware'=>['auth']]);
Route::get('/friends/accept/{username}',['uses'=>'FriendsController@getAccept','as'=>'friends.accept','middleware'=>['auth']]);

Route::post('/status',['uses'=>'StatusController@postStatus','as'=>'status.post','middleware'=>['auth']]);

Route::get('/blog/{id}',['uses'=>'BlogController@showBlog','as'=>'blog.index']);
Route::get('/blog/{id}/create',['uses'=>'BlogController@create','as'=>'blog.create','middleware'=>['auth']]);
Route::post('/blog/{id}/create',['uses'=>'BlogController@store','as'=>'blog.post','middleware'=>['auth']]);

Route::get('/album/{id}',['uses'=>'AlbumController@index','as'=>'album.index']);
Route::get('/album/{id}/create',['uses'=>'AlbumController@create','as'=>'album.create','middleware'=>['auth']]);
Route::post('/album/{id}/create',['uses'=>'AlbumController@store','as'=>'album.store','middleware'=>['auth']]);

Route::get('/photos/{album_id}',['uses'=>'PhotoController@index','as'=>'photo.index']);
Route::post('/photos/{album_id}/store',['uses'=>'PhotoController@store','as'=>'photo.store','middleware'=>['auth']]);
Route::get('/photo/{photo_id}',['uses'=>'PhotoController@single','as'=>'photo.single']);


