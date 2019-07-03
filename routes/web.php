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

Route::get('/home', 'HomeController@index')->name('home');

Route::get('logout', 'Auth\LoginController@logout')->name('logout');

Route::post('save-get-call-request', 'HomeController@saveGetCallRequest')->name('saveGetCallRequest');

Route::post('/check-user-email', 'HomeController@checkUserEmail')->name('checkUserEmail');
Route::post('/check-user-mobile', 'HomeController@checkUserMobile')->name('checkUserMobile');



Route::group(['prefix' => 'admin-panel', 'namespace' => 'Admin'], function () {

	// Authentication Routes...
	Route::get('login', 'Auth\LoginController@showLoginForm')->name('admin.login');
	Route::post('login', 'Auth\LoginController@login')->name('admin.postlogin');
	Route::get('logout', 'Auth\LoginController@logout')->name('admin.logout');

	// Registration Routes...
	Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('admin.register');
	Route::post('register', 'Auth\RegisterController@register')->name('admin.postregister');;

	// Password Reset Routes...
	Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('admin.auth.password.reset');
	Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('admin.passwordemail');
	Route::get('password/reset/{token?}', 'Auth\ResetPasswordController@showResetForm')->name('admin.auth.password.reset');
	Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('admin.resetpassword');

	//Dashboard Route....
	Route::get('/', 'AdminController@index')->name('admin.dashboard');
	Route::get('/change-password', 'AdminController@changePassword')->name('admin.changePassoword');
	Route::post('/update-password', 'AdminController@updatePassword')->name('admin.updatePassword');

	//Role Routes...
	Route::get('/role-list', 'RoleController@roleList')->name('roleList');
	Route::get('/add-role', 'RoleController@addRole')->name('addRole');
	Route::post('/save-role', 'RoleController@saveRole')->name('saveRole');
	Route::get('/edit-role/{id}', 'RoleController@editRole')->name('editRole');
	Route::post('/save-edited-role', 'RoleController@saveEditedRole')->name('saveEditedRole');
	Route::get('/delete-role/{id}', 'RoleController@deleteRole')->name('deleteRole');

	//User Routes...
	Route::match(array('get','post'),'/user-list', 'UserController@userList')->name('userList');
	Route::get('/add-user', 'UserController@addUser')->name('addUser');
	Route::post('/save-user', 'UserController@saveUser')->name('saveUser');
	Route::get('/edit-user/{role_id}/{id}', 'UserController@editUser')->name('editUser');
	Route::post('/save-edited-user', 'UserController@saveEditedUser')->name('saveEditedUser');
	Route::get('/delete-user/{id}', 'UserController@deleteUser')->name('deleteUser');
  	Route::post('/check-email', 'UserController@checkEmail')->name('checkEmail');
  	Route::post('/check-mobile-number', 'UserController@checkMobileNumber')->name('checkMobileNumber');

});

Route::group(['prefix' => 'call-center-agent', 'namespace' => 'Callcenter'], function () {

	// Authentication Routes...
	Route::get('login', 'Auth\LoginController@showLoginForm')->name('callcenter.login');
	Route::post('login', 'Auth\LoginController@login')->name('callcenter.postlogin');
	Route::get('logout', 'Auth\LoginController@logout')->name('callcenter.logout');

	// Registration Routes...
	Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('callcenter.register');
	Route::post('register', 'Auth\RegisterController@register')->name('callcenter.postregister');;

	// Password Reset Routes...
	Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('callcenter.auth.password.reset');
	Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('callcenter.passwordemail');
	Route::get('password/reset/{token?}', 'Auth\ResetPasswordController@showResetForm')->name('callcenter.auth.password.reset');
	Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('callcenter.resetpassword');

	//Dashboard Route....
	Route::get('/', 'CallCenterController@index')->name('callcenter.dashboard');
	Route::get('/change-password', 'CallCenterController@changePassword')->name('callcenter.changePassoword');
	Route::post('/update-password', 'CallCenterController@updatePassword')->name('callcenter.updatePassword');

	//Get call request
	Route::get('/get-call-request', 'CallRequestController@getCallRequest')->name('callcenter.getCallRequest');

	//user route
	Route::get('/edit-user-info/{id}', 'UserController@editUserInfo')->name('callcenter.editUserInfo');	
	Route::post('/save-user-info', 'UserController@saveUserInfo')->name('callcenter.saveUserInfo');	
	
	Route::post('/get-lead-assistant', 'UserController@getLeadAssistant')->name('callcenter.getLeadAssistant');	
});

Route::group(['prefix' => 'lead-assistant', 'namespace' => 'Leadassistant'], function () {

	// Authentication Routes...
	Route::get('login', 'Auth\LoginController@showLoginForm')->name('lead_assistant.login');
	Route::post('login', 'Auth\LoginController@login')->name('lead_assistant.postlogin');
	Route::get('logout', 'Auth\LoginController@logout')->name('lead_assistant.logout');

	// Registration Routes...
	Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('lead_assistant.register');
	Route::post('register', 'Auth\RegisterController@register')->name('lead_assistant.postregister');;

	// Password Reset Routes...
	Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('lead_assistant.auth.password.reset');
	Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('lead_assistant.passwordemail');
	Route::get('password/reset/{token?}', 'Auth\ResetPasswordController@showResetForm')->name('lead_assistant.auth.password.reset');
	Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('lead_assistant.resetpassword');

	//Dashboard Route....
	Route::get('/', 'LeadAssistantController@index')->name('lead_assistant.dashboard');
	Route::get('/change-password', 'LeadAssistantController@changePassword')->name('lead_assistant.changePassoword');
	Route::post('/update-password', 'LeadAssistantController@updatePassword')->name('lead_assistant.updatePassword');

	//Get call request
	Route::get('/get-lead-request', 'LeadRequestController@getLeadRequest')->name('lead_assistant.getLeadRequest');

});

Route::group(['prefix' => 'tech-partner', 'namespace' => 'Techpartner'], function () {

	// Authentication Routes...
	Route::get('login', 'Auth\LoginController@showLoginForm')->name('tech_partner.login');
	Route::post('login', 'Auth\LoginController@login')->name('tech_partner.postlogin');
	Route::get('logout', 'Auth\LoginController@logout')->name('tech_partner.logout');

	// Registration Routes...
	Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('tech_partner.register');
	Route::post('register', 'Auth\RegisterController@register')->name('tech_partner.postregister');;

	// Password Reset Routes...
	Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('tech_partner.auth.password.reset');
	Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('tech_partner.passwordemail');
	Route::get('password/reset/{token?}', 'Auth\ResetPasswordController@showResetForm')->name('tech_partner.auth.password.reset');
	Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('tech_partner.resetpassword');

	//Dashboard Route....
	Route::get('/', 'TechPartnerController@index')->name('tech_partner.dashboard');
	Route::get('/change-password', 'TechPartnerController@changePassword')->name('tech_partner.changePassoword');
	Route::post('/update-password', 'TechPartnerController@updatePassword')->name('tech_partner.updatePassword');

});



