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

Auth::routes();

Route::group(['prefix'=>'admin','namespace'=>'Admin', 'middleware' => 'auth' ],function(){

    Route::get('/', 'HomeController@home')->name('admin.home');
    Route::resource('category','CategoryController');
    Route::resource('post','PostController');
    Route::get('post/publish/{id}', 'PostController@publish')->name('post.publish');
    Route::resource('user','UserController');
    Route::resource('role','RoleController');
    Route::resource('permission','PermissionController');
    
});

Route::get('/home', 'HomeController@index')->name('home');
