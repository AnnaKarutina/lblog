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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// List all posts
Route::get('posts', 'PostController@index');

// Show single post
Route::get('post/{id}', 'PostController@show');

// Add a new post
Route::post('post', 'PostController@store');

// Modify an existing post
Route::put('post', 'PostController@store');

// Delete a post
Route::delete('post/{id}', 'PostController@destroy');

// List all tags
Route::get('tags', 'TagController@index');