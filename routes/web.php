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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'PostController@home');

Route::get('/posts/{id}', 'PostController@details');
Route::get('/admin/posts', 'PostController@create');

Route::get('/about', function () {
    return view('layouts.pages.about');
});

Route::get('/users/{user}', 'UserController@details');
Route::get('/admin/users', 'AdminUserController@listUsers');
Route::get('/admin/users/{user}', 'AdminUserController@edit');

Route::get('/contact', 'ContactController@create');