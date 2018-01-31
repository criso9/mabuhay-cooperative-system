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
    return view('admin.index');
});


Route::get('login', array('as' => 'login', 'uses' => 'Auth\LoginController@getLogin'));
Route::post('login', array('as' => 'login.post','uses' => 'Auth\LoginController@postLogin'));
Route::post('logout', array('as' => 'logout', 'uses' => 'Auth\LoginController@getLogout'));

Route::get('/admin/role', function () {
    return view('admin.crud.role');
});

// Admin panel
Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
   // Route::resource('users', 'Admin\UserController', ['as' => 'admin']);
   Route::get('users/member', array('as' => 'admin.member.show','uses' => 'Admin\UserController@showMember'));
});