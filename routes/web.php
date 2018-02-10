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
//     return view('home.index');
// });

Route::get('/', array('as' => 'home.index', 'uses' => 'Home\HomeController@index'));


Route::get('login', array('as' => 'login', 'uses' => 'Auth\LoginController@getLogin'));
Route::post('login', array('as' => 'login.post','uses' => 'Auth\LoginController@postLogin'));
Route::post('logout', array('as' => 'logout', 'uses' => 'Auth\LoginController@getLogout'));

// Route::get('/register', function () {
// return view('register');
// });

Route::get('/register',array('as' =>'register.get', 'uses' => 'Auth\RegisterController@index'));
Route::post('/register',array('as' =>'register.post', 'uses' => 'Auth\RegisterController@store'));


// Route::get('/admin/role', function () {
//     return view('admin.crud.role');
// });

//Route::get('admin/users/member', array('as' => 'admin.member.show','uses' => 'Admin\UserController@showMember'));

// Admin panel
Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
   // Route::resource('users', 'Admin\UserController', ['as' => 'admin']);
	Route::get('/', array('as' => 'admin.index','uses' => 'Admin\AdminController@index'));
	
   Route::get('users/member', array('as' => 'admin.member.index','uses' => 'Admin\UserController@indexMember'));
   Route::get('users/member/{member}', array('as' => 'admin.member.show','uses' => 'Admin\UserController@showMember'));
   Route::get('users/member/{member}/edit', array('as' => 'admin.member.edit','uses' => 'Admin\UserController@editMember'));
   Route::put('users/member/{member}', array('as' => 'admin.member.update','uses' => 'Admin\UserController@updateMember'));
   Route::get('users/member/create}', array('as' => 'admin.member.create','uses' => 'Admin\UserController@createMember'));

   Route::get('coop', array('as' => 'admin.coop','uses' => 'Admin\CoopController@index'));
   Route::post('coop', array('as' => 'admin.coop','uses' => 'Admin\CoopController@store'));
});