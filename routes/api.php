<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/users', 'User\SearchController@search');
Route::post('/register', 'Auth\RegisterController@register');
Route::post('/login', 'Auth\LoginController@login');
Route::get('/user/{id}', 'User\ProfileController@getInfo');
Route::get('/post', 'Post\SearchController@search');


Route::middleware(['auth:api'])->group(function () {   
    Route::post('/post', 'Post\CreateController@create');    
    Route::delete('/post/{id}', 'Post\DeleteController@delete');

    Route::post('/post/image', 'Post\Image\CreateController@create');    

    Route::post('/logout', 'Auth\LoginController@logout');
    Route::get('/user', function (Request $request) {
    	return response($request->user());
    });
    Route::post('/user/picture', 'User\ProfileController@uploadPicture');
    Route::post('/user', 'User\ProfileController@updateProfile');
});