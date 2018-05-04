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
Route::get('/about', array('as' => 'home.about', 'uses' => 'Home\HomeController@about'));
Route::get('/services', array('as' => 'home.services', 'uses' => 'Home\HomeController@services'));
Route::get('/contacts', array('as' => 'home.contacts', 'uses' => 'Home\HomeController@contacts'));

Route::get('/page_403', array('as' => 'forbidden','uses' => 'Home\HomeController@forbidden'));


Route::get('login', array('as' => 'login', 'uses' => 'Auth\LoginController@getLogin'));
Route::post('login', array('as' => 'login.post','uses' => 'Auth\LoginController@postLogin'));
Route::post('logout', array('as' => 'logout', 'uses' => 'Auth\LoginController@getLogout'));

// Route::get('/register', function () {
// return view('register');
// });

Route::get('/register',array('as' =>'register.get', 'uses' => 'Auth\RegisterController@index'));
Route::post('/register',array('as' =>'register.post', 'uses' => 'Auth\RegisterController@store'));

Route::get('confirmation', array('as' => 'confirmation', 'uses' => 'Admin\UserController@confirmation'));

// Route::get('/admin/role', function () {
//     return view('admin.crud.role');
// });

//Route::get('admin/users/member', array('as' => 'admin.member.show','uses' => 'Admin\UserController@showMember'));

Route::post('send/loanapproval', array('as' => 'officer.email.loan.approval', 'uses' => 'EmailController@loanApproval'));


// Admin panel
Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
   // Route::resource('users', 'Admin\UserController', ['as' => 'admin']);
	Route::get('/', array('as' => 'admin.index','uses' => 'Admin\AdminController@index'));

   Route::get('users/member', array('as' => 'admin.member.index','uses' => 'Admin\UserController@indexMember'));
   Route::post('users/member', array('as' => 'admin.member.index.filter','uses' => 'Admin\UserController@memberFilter'));

   Route::get('users/member/show/{member}', array('as' => 'admin.member.show','uses' => 'Admin\UserController@showMember'));
   Route::get('users/member/{member}/edit', array('as' => 'admin.member.edit','uses' => 'Admin\UserController@editMember'));
   Route::put('users/member/{member}', array('as' => 'admin.member.update','uses' => 'Admin\UserController@updateMember'));

   Route::get('users/member/add', array('as' => 'admin.member.create','uses' => 'Admin\UserController@createMember'));
   // Route::post('users/member/add', array('as' => 'admin.member.store','uses' => 'Admin\UserController@storeMember'));

   Route::get('users/officer', array('as' => 'admin.officer.index','uses' => 'Admin\UserController@indexOfficer'));
   Route::post('users/officer', array('as' => 'admin.officer.range','uses' => 'Admin\UserController@dateRange'));
   Route::post('users/officer/add', array('as' => 'admin.officer.store','uses' => 'Admin\UserController@storeOfficer'));
   Route::put('users/officer', array('as' => 'admin.officer.update','uses' => 'Admin\UserController@updateOfficer'));

   Route::get('users/admin', array('as' => 'admin.admin.index','uses' => 'Admin\UserController@indexAdmin'));
   // Route::post('users/officer', array('as' => 'admin.officer.range','uses' => 'Admin\UserController@dateRange'));
   Route::post('users/admin/add', array('as' => 'admin.admin.store','uses' => 'Admin\UserController@storeAdmin'));
   Route::put('users/admin', array('as' => 'admin.admin.update','uses' => 'Admin\UserController@updateAdmin'));

   Route::get('coop', array('as' => 'admin.coop','uses' => 'Admin\CoopController@index'));
   Route::post('coop', array('as' => 'admin.coop','uses' => 'Admin\CoopController@store'));

   Route::post('coop/add', array('as' => 'admin.coop.store','uses' => 'Admin\CoopController@addImage'));
   Route::put('coop/delete', array('as' => 'admin.coop.delete','uses' => 'Admin\CoopController@deleteImage'));

   Route::post('coop/addFile', array('as' => 'admin.coop.store.file','uses' => 'Admin\CoopController@addFile'));
   Route::put('coop/deleteFile', array('as' => 'admin.coop.delete.file','uses' => 'Admin\CoopController@deleteFile'));

   Route::get('users/pending', array('as' => 'admin.pending.index','uses' => 'Admin\UserController@indexPending'));
   Route::post('users/pending', array('as' => 'admin.pending.index.type','uses' => 'Admin\UserController@indexPendingType'));

   Route::post('send/approval', array('as' => 'admin.email.approval', 'uses' => 'EmailController@userApproval'));

   Route::get('backup', array('as' => 'admin.backup.index','uses' => 'Admin\AdminController@indexBackup'));
   
   Route::get('backup/database/create', array('as' => 'admin.backup.database.create','uses' => 'Admin\AdminController@createBackupDb'));
   Route::get('backup/app/create', array('as' => 'admin.backup.app.create','uses' => 'Admin\AdminController@createBackupApp'));

   Route::get('backup/download/{file_name}', array('as' => 'admin.backup.download','uses' => 'Admin\AdminController@downloadBackup'));
   Route::get('backup/delete/{file_name}', array('as' => 'admin.backup.delete','uses' => 'Admin\AdminController@deleteBackup'));

   Route::get('business', array('as' => 'admin.business.index','uses' => 'Admin\AdminController@businessList'));
   Route::post('business', array('as' => 'admin.business.index.filter','uses' => 'Admin\AdminController@businessFilter'));
   Route::put('business', array('as' => 'admin.business.update','uses' => 'Admin\AdminController@businessUpdate'));

   Route::post('business/add', array('as' => 'admin.business.store','uses' => 'Admin\AdminController@businessAdd'));
});

// Officer panel
Route::group(['prefix' => 'officer', 'middleware' => 'officer'], function () {
	Route::get('/', array('as' => 'officer.index','uses' => 'Officer\OfficerController@index'));

	Route::get('/contribution/month', array('as' => 'officer.contribution.monthly','uses' => 'Officer\OfficerController@monthlyContribution'));
	Route::post('/contribution/month', array('as' => 'officer.contribution.monthly.year','uses' => 'Officer\OfficerController@monthlyContributionYearSelected'));
	Route::post('/contribution/month/info', array('as' => 'officer.contribution.monthly.info','uses' => 'Officer\OfficerController@monthlyContributionInfo'));

	Route::get('/contribution/damayan', array('as' => 'officer.contribution.damayan','uses' => 'Officer\OfficerController@damayanContribution'));
	Route::get('/contribution/sharecapital', array('as' => 'officer.contribution.sharecapital','uses' => 'Officer\OfficerController@sharecapitalContribution'));

	 // Route::get('contribution/add', array('as' => 'officer.contribution.add','uses' => 'Officer\OfficerController@addContribution'));
	 Route::post('contribution/add', array('as' => 'officer.contribution.store','uses' => 'Officer\OfficerController@storeContribution'));

	  Route::get('/loan', array('as' => 'officer.loan.index','uses' => 'Officer\OfficerController@loan'));
     Route::post('/loan', array('as' => 'officer.loan.index.filter','uses' => 'Officer\OfficerController@loanFilter'));

     Route::post('/loan/approval', array('as' => 'officer.loan.approval', 'uses' => 'Officer\OfficerController@loanApproval'));

     Route::post('/loan/payment', array('as' => 'officer.loan.store','uses' => 'Officer\OfficerController@loanPayment'));

     Route::get('/business', array('as' => 'officer.business.index','uses' => 'Officer\OfficerController@businessList'));
     Route::post('/business', array('as' => 'officer.business.index.filter','uses' => 'Officer\OfficerController@businessFilter'));

     Route::get('/member', array('as' => 'officer.member.index','uses' => 'Officer\OfficerController@indexMember'));
   Route::post('/member', array('as' => 'officer.member.index.filter','uses' => 'Officer\OfficerController@memberFilter'));

   Route::get('/member/show/{member}', array('as' => 'officer.member.show','uses' => 'Officer\OfficerController@showMember'));
	
});

// Member panel
Route::group(['prefix' => 'member', 'middleware' => 'member'], function () {
	Route::get('/', array('as' => 'member.index','uses' => 'Member\MemberController@index'));
	
	Route::get('/contribution/month', array('as' => 'member.contribution.monthly','uses' => 'Member\MemberController@monthlyContribution'));
	Route::post('/contribution/month', array('as' => 'member.contribution.monthly.year','uses' => 'Member\MemberController@monthlyContributionYearSelected'));

	Route::get('/contribution/other', array('as' => 'member.contribution.other','uses' => 'Member\MemberController@otherContribution'));

	Route::get('/loan', array('as' => 'member.loan.index','uses' => 'Member\MemberController@loan'));
	Route::post('/loan', array('as' => 'member.loan.index.filter','uses' => 'Member\MemberController@loanFilter'));

	
	// Route::get('/loan/apply', array('as' => 'member.loan.apply','uses' => 'Member\MemberController@loanApply'));
	Route::post('/loan/apply', array('as' => 'member.loan.store','uses' => 'Member\MemberController@storeLoan'));

	Route::get('/report', array('as' => 'member.report','uses' => 'Member\MemberController@report'));
});