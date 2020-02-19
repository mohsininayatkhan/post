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

Route::post('/register', 'Auth\RegisterController@register');
Route::post('/login', 'Auth\LoginController@login');

Route::get('/post', 'Post\SearchController@search');

Route::middleware(['auth:api'])->group(function () {   
    Route::post('/post', 'Post\CreateController@create');
    Route::delete('/post/{id}', 'Post\DeleteController@delete');
    Route::post('/logout', 'Auth\LoginController@logout');
    Route::get('/user', function (Request $request) {
    	return response($request->user());
    });
    Route::post('/user/picture', 'User\ProfileController@uploadPicture');
});