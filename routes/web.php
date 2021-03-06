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

$prefix = config('larapoll_config.prefix');

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

Route::get('send/loanreminder/{loan}', array('as' => 'officer.email.loan.reminder', 'uses' => 'EmailController@loanReminder'));

Route::get('send/announcementreminder/{id}', array('as' => 'officer.email.announcement.reminder', 'uses' => 'EmailController@announcementReminder'));

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
   Route::get('backup/restore/{file_name}', array('as' => 'admin.backup.restore','uses' => 'Admin\AdminController@restoreBackup'));

   Route::get('business', array('as' => 'admin.business.index','uses' => 'Admin\AdminController@businessList'));
   Route::post('business', array('as' => 'admin.business.index.filter','uses' => 'Admin\AdminController@businessFilter'));
   Route::put('business', array('as' => 'admin.business.update','uses' => 'Admin\AdminController@businessUpdate'));

   Route::post('business/add', array('as' => 'admin.business.store','uses' => 'Admin\AdminController@businessAdd'));

   Route::get('business/{name}', array('as' => 'admin.business.show','uses' => 'Admin\AdminController@viewBusiness'));
    Route::post('business/{name}', array('as' => 'admin.business.show.store','uses' => 'Admin\AdminController@addBusinessIncome'));

    Route::get('polls', ['uses' => 'Admin\AdminController@indexPoll', 'as' => 'admin.poll.index']);
    Route::get('polls/create', ['uses' => 'Admin\AdminController@createPoll', 'as' => 'admin.poll.create']);

    Route::get('polls/{poll}', ['uses' => 'Admin\AdminController@editPoll', 'as' => 'admin.poll.edit']);

    Route::post('polls/{poll}', ['uses' => 'Admin\AdminController@updatePoll', 'as' => 'admin.poll.update']);

    Route::delete('polls/{poll}', ['uses' => 'Admin\AdminController@removePoll', 'as' => 'admin.poll.remove']);

    Route::patch('polls/{poll}/lock', ['uses' => 'Admin\AdminController@lockPoll', 'as' => 'admin.poll.lock']);

    Route::patch('polls/{poll}/unlock', ['uses' => 'Admin\AdminController@unlockPoll', 'as' => 'admin.poll.unlock']);

    Route::post('polls', ['uses' => 'Admin\AdminController@storePoll', 'as' => 'admin.poll.store']);

    Route::get('polls/{poll}/options/add', ['uses' => 'Admin\AdminController@pushPoll', 'as' => 'admin.poll.options.push']);

    Route::post('polls/{poll}/options/add', ['uses' => 'Admin\AdminController@addPollOptions', 'as' => 'admin.poll.options.add']);

    Route::get('polls/{poll}/options/remove', ['uses' => 'Admin\AdminController@deletePollOptions', 'as' => 'admin.poll.options.remove']);

    Route::delete('polls/{poll}/options/remove', ['uses' => 'Admin\AdminController@removePollOptions', 'as' => 'admin.poll.options.remove']);

});

// Officer panel
Route::group(['prefix' => 'officer', 'middleware' => 'officer'], function () {
	Route::get('/', array('as' => 'officer.index','uses' => 'Officer\OfficerController@index'));

	Route::get('/contribution/month', array('as' => 'officer.contribution.monthly','uses' => 'Officer\OfficerController@monthlyContribution'));
	Route::post('/contribution/month', array('as' => 'officer.contribution.monthly.year','uses' => 'Officer\OfficerController@monthlyContributionYearSelected'));

  Route::get('contribution/month/{member}', array('as' => 'officer.contribution.monthly.member','uses' => 'Officer\OfficerController@monthlyMemberContribution'));
  Route::post('contribution/month/{member}', array('as' => 'officer.contribution.monthly.member.year','uses' => 'Officer\OfficerController@memberYearSelected'));

	Route::get('/contribution/damayan', array('as' => 'officer.contribution.damayan','uses' => 'Officer\OfficerController@damayanContribution'));
	Route::get('/contribution/sharecapital', array('as' => 'officer.contribution.sharecapital','uses' => 'Officer\OfficerController@sharecapitalContribution'));

	 // Route::get('contribution/add', array('as' => 'officer.contribution.add','uses' => 'Officer\OfficerController@addContribution'));
	 Route::post('contribution/add', array('as' => 'officer.contribution.store','uses' => 'Officer\OfficerController@storeContribution'));

	  Route::get('/loan', array('as' => 'officer.loan.index','uses' => 'Officer\OfficerController@loan'));
     Route::post('/loan', array('as' => 'officer.loan.index.filter','uses' => 'Officer\OfficerController@loanFilter'));

     Route::post('/loan/approval', array('as' => 'officer.loan.approval', 'uses' => 'Officer\OfficerController@loanApproval'));

     Route::get('/loan/payment/{trans}', array('as' => 'officer.loan.payment','uses' => 'Officer\OfficerController@loanPaymentView'));

     Route::post('/loan/payment', array('as' => 'officer.loan.store','uses' => 'Officer\OfficerController@loanPayment'));

     Route::get('/business', array('as' => 'officer.business.index','uses' => 'Officer\OfficerController@businessList'));
     Route::post('/business', array('as' => 'officer.business.index.filter','uses' => 'Officer\OfficerController@businessFilter'));

     Route::get('/member', array('as' => 'officer.member.index','uses' => 'Officer\OfficerController@indexMember'));
   Route::post('/member', array('as' => 'officer.member.index.filter','uses' => 'Officer\OfficerController@memberFilter'));

   Route::get('/member/show/{member}', array('as' => 'officer.member.show','uses' => 'Officer\OfficerController@showMember'));

   Route::get('/documents', array('as' => 'officer.documents.index','uses' => 'Officer\OfficerController@documentsList'));
   Route::post('documents/add', array('as' => 'officer.documents.store','uses' => 'Officer\OfficerController@documentsAdd'));

   Route::get('documents/delete/{file_id}', array('as' => 'officer.documents.delete','uses' => 'Officer\OfficerController@documentsDelete'));

   Route::get('documents/download/{file_id}', array('as' => 'officer.documents.download','uses' => 'Officer\OfficerController@documentsDownload'));

   
   Route::get('/announcements', array('as' => 'officer.announcements.index','uses' => 'Officer\OfficerController@announcementList'));

   Route::post('announcements/add', array('as' => 'officer.announcements.store','uses' => 'Officer\OfficerController@announcementAdd'));

   Route::post('announcements/delete', array('as' => 'officer.announcements.delete','uses' => 'Officer\OfficerController@announcementDelete'));

   Route::get('announcements/edit/{id}', array('as' => 'officer.announcements.edit','uses' => 'Officer\OfficerController@announcementEdit'));

   Route::post('announcements/edit/{id}', array('as' => 'officer.announcements.update','uses' => 'Officer\OfficerController@announcementUpdate'));
	
});

// Member panel
Route::group(['prefix' => 'member', 'middleware' => 'member'], function () {
	Route::get('/', array('as' => 'member.index','uses' => 'Member\MemberController@index'));
	
	Route::get('/contribution/month', array('as' => 'member.contribution.monthly','uses' => 'Member\MemberController@monthlyContribution'));
	Route::post('/contribution/month', array('as' => 'member.contribution.monthly.year','uses' => 'Member\MemberController@monthlyContributionYearSelected'));

  Route::get('/contribution/damayan', array('as' => 'member.contribution.damayan','uses' => 'Member\MemberController@damayanContribution'));

  Route::get('/contribution/sharecapital', array('as' => 'member.contribution.sharecapital','uses' => 'Member\MemberController@sharecapitalContribution'));

	Route::get('/loan', array('as' => 'member.loan.index','uses' => 'Member\MemberController@loan'));
	Route::post('/loan', array('as' => 'member.loan.index.filter','uses' => 'Member\MemberController@loanFilter'));

	Route::get('/loan/cash', array('as' => 'member.loan.cash','uses' => 'Member\MemberController@loanCash'));

  Route::get('/loan/motor', array('as' => 'member.loan.motor','uses' => 'Member\MemberController@loanMotor'));
  Route::post('/loan/motor', array('as' => 'member.loan.motor.store','uses' => 'Member\MemberController@storeLoanMotor'));

	// Route::get('/loan/apply', array('as' => 'member.loan.apply','uses' => 'Member\MemberController@loanApply'));
	Route::post('/loan/apply', array('as' => 'member.loan.store','uses' => 'Member\MemberController@storeLoan'));

	Route::get('/report', array('as' => 'member.report','uses' => 'Member\MemberController@report'));

  Route::post('/polls/vote/{poll}', array('as' => 'member.poll.vote','uses' => 'Admin\AdminController@votePoll'));

  Route::get('/profile', array('as' => 'member.profile.edit','uses' => 'Member\MemberController@profileEdit'));

  Route::post('/profile', array('as' => 'member.profile.update','uses' => 'Member\MemberController@profileUpdate'));

  Route::get('/password', array('as' => 'member.password.edit','uses' => 'Member\MemberController@passwordEdit'));

  Route::post('/password', array('as' => 'member.password.update','uses' => 'Member\MemberController@passwordUpdate'));

});