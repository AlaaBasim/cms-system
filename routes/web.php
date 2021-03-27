<?php

use Illuminate\Support\Facades\Route;


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


Route::get('/in', function () {
    echo ('I am Alaa. I created this website');
});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/post/{post}', 'PostController@show')->name('post.show');

Route::middleware('auth')-> group(function(){
    
    Route::get('/admin', 'AdminController@index')->name('admin.index');
    Route::get('/admin/post/create', 'PostController@create')->name('post.create');
    Route::get('/admin/posts', 'PostController@index')->name('post.index');

    Route::post('/admin/post', 'PostController@store')->name('post.store');

    Route::get('/admin/post/{post}/edit', 'PostController@edit')->name('post.edit');
    Route::patch('/admin/post/{post}/update', 'PostController@update')->name('post.update');
    Route::delete('/admin/post/{post}/destroy', 'PostController@destroy')->name('post.destroy');

    Route::put('/users/{user}/update', 'UserController@update')->name('user.profile.update');
    Route::delete('/users/{user}/delete', 'UserController@destroy')->name('user.destroy');
});


Route::middleware(['role:Admin', 'auth'])-> group(function(){

    Route::get('/admin/users', 'UserController@index')->name('users.index');

    Route::get('/users/{user}/profile', 'UserController@show')->name('user.profile.show');
    Route::put('/user/{user}/attach', 'UserController@attach')->name('user.role.attach');
    Route::put('/user/{user}/detach', 'UserController@detach')->name('user.role.detach');
});

Route::middleware(['auth', 'can:view,user'])-> group(function(){

    Route::get('/users/{user}/profile', 'UserController@show')->name('user.profile.show');
});


//Route::get('/admin/post/{post}/edit', 'PostController@edit')->middleware('can:view,post')->name('post.edit');

Route::middleware(['role:Admin', 'auth'])-> group(function(){
    Route::get('/roles', 'RoleController@index')->name('roles.index');
    Route::post('/roles/store', 'RoleController@store')->name('roles.store');
    Route::delete('/roles/{role}/destroy', 'RoleController@destroy')->name('roles.destroy');
    Route::get('/roles/{role}/edit', 'RoleController@edit')->name('roles.edit');
    Route::put('/roles/{role}/update', 'RoleController@update')->name('roles.update');


    Route::get('/permissions', 'PermissionController@index')->name('permissions.index');
    Route::delete('/permissions/{permission}/destroy', 'PermissionController@destroy')->name('permissions.destroy');
    Route::put('/permissions/roles/{role}/attach', 'PermissionController@attach')->name('role.permission.attach');
    Route::put('/permissions/roles/{role}/detach', 'PermissionController@detach')->name('role.permission.detach');
    Route::get('/permission/{permission}/edit', 'PermissionController@edit')->name('permissions.edit');
    Route::post('/permissions/store', 'PermissionController@store')->name('permissions.store');
    Route::put('/permissions/{permission}/update', 'PermissionController@update')->name('permissions.update');
});