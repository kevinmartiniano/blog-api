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

Route::prefix('v1')->group(function () {
    Route::resources([
        'posts' => 'AdminPostController',
        'comments' => 'CommentController',
        'users' => 'AdminUserController',
        'user-types' => 'UserTypeController',
    ], [
        'except' => ['create', 'edit'],
    ]);
});

Route::prefix('v1')->group(function () {
    Route::post('contact', 'ContactController@store');
    Route::get('contact', 'ContactController@index');
});