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

Route::get('/', 'HomeController@index');



Route::get('/about', function () {
    return view('layouts.pages.about');
});

Route::resources([
    'users' => 'UserController',
    'posts' => 'PostController',
]);

Route::get('/admin/posts', 'PostController@create');

Route::get('/contact', 'ContactController@create');