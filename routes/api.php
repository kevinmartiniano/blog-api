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

Route::middleware("auth:api")->prefix('v1')->group(function () {
    Route::resources([
        'posts' => 'PostController',
        'comments' => 'CommentController',
        'likes' => 'LikeController',
        'users' => 'UserController',
        'user-types' => 'UserTypeController',
        'admin/users' => 'AdminUserController',
    ]);
});

// Route::prefix('v1')->group(function () {
//     Route::resources([
//         'posts' => 'PostController',
//         'comments' => 'CommentController',
//         'likes' => 'LikeController',
//         'users' => 'UserController',
//         'user-types' => 'UserTypeController',
//         'admin/users' => 'AdminUserController',
//     ]);
// });

Route::prefix('v1')->group(function () {
    Route::post('contact', 'ContactController@store');
    Route::get('contact', 'ContactController@index');

    // Route::get('users/{user}', 'UserController@show');

    // Route::put('users/{user}', 'AdminUserController@update');
});