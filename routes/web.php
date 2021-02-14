<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;


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



Route::get('/a', function () {
    echo ('I am Alaa. I created this website');
});

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
//Another syntax
//Route::get('/', 'HomeController@index')->name('home');

Route::get('/post/{post}', 'App\Http\Controllers\PostController@show')->name('post.show');

Route::middleware('auth')-> group(function(){
    
    Route::get('/admin', 'App\Http\Controllers\AdminController@index')->name('admin.index');
    Route::get('/admin/post/create', 'App\Http\Controllers\PostController@create')->name('post.create');
    Route::get('/admin/posts', 'App\Http\Controllers\PostController@index')->name('post.index');

    Route::post('/admin/post', 'App\Http\Controllers\PostController@store')->name('post.store');

    Route::get('/admin/post/{post}/edit', 'App\Http\Controllers\PostController@edit')->name('post.edit');
    Route::patch('/admin/post/{post}/update', 'App\Http\Controllers\PostController@update')->name('post.update');
    Route::delete('/admin/post/{post}/destroy', 'App\Http\Controllers\PostController@destroy')->name('post.destroy');

    Route::put('/users/{user}/update', 'App\Http\Controllers\UserController@update')->name('user.profile.update');

    
    Route::delete('/users/{user}/delete', 'App\Http\Controllers\UserController@destroy')->name('user.destroy');
});


Route::middleware(['role:Admin', 'auth'])-> group(function(){

    Route::get('/admin/users', 'App\Http\Controllers\UserController@index')->name('users.index');

    Route::get('/users/{user}/profile', 'App\Http\Controllers\UserController@show')->name('user.profile.show');
    Route::put('/user/{user}/attach', 'App\Http\Controllers\UserController@attach')->name('user.role.attach');
    Route::put('/user/{user}/detach', 'App\Http\Controllers\UserController@detach')->name('user.role.detach');
});

Route::middleware(['auth', 'can:view,user'])-> group(function(){

    Route::get('/users/{user}/profile', 'App\Http\Controllers\UserController@show')->name('user.profile.show');
});


//Route::get('/admin/post/{post}/edit', 'App\Http\Controllers\PostController@edit')->middleware('can:view,post')->name('post.edit');

Route::middleware(['role:Admin', 'auth'])-> group(function(){
    Route::get('/roles', 'App\Http\Controllers\RoleController@index')->name('roles.index');
    Route::post('/roles/store', 'App\Http\Controllers\RoleController@store')->name('roles.store');
    Route::delete('/roles/{role}/destroy', 'App\Http\Controllers\RoleController@destroy')->name('roles.destroy');
    Route::get('/roles/{role}/edit', 'App\Http\Controllers\RoleController@edit')->name('roles.edit');
    Route::put('/roles/{role}/update', 'App\Http\Controllers\RoleController@update')->name('roles.update');


    Route::get('/permissions', 'App\Http\Controllers\PermissionController@index')->name('permissions.index');
    Route::delete('/permissions/{permission}/destroy', 'App\Http\Controllers\PermissionController@destroy')->name('permissions.destroy');
    Route::put('/permissions/roles/{role}/attach', 'App\Http\Controllers\PermissionController@attach')->name('role.permission.attach');
    Route::put('/permissions/roles/{role}/detach', 'App\Http\Controllers\PermissionController@detach')->name('role.permission.detach');
    Route::get('/permission/{permission}/edit', 'App\Http\Controllers\PermissionController@edit')->name('permissions.edit');
    Route::post('/permissions/store', 'App\Http\Controllers\PermissionController@store')->name('permissions.store');
    Route::put('/permissions/{permission}/update', 'App\Http\Controllers\PermissionController@update')->name('permissions.update');
});