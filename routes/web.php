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

Route::get('/', function () {
    // return view('pages/home-page');
    return view('layouts.pages.home');
});

Route::get('/posts/{id}', function () {
    return view('layouts.pages.post');
});

Route::get('/about', function () {
    return view('layouts.pages.about');
});

Route::get('/contact', function () {
    return view('layouts.pages.contact');
});