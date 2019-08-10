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

Route::get('/', 'HomeController@index')->name('index');

Route::get('logout', 'Auth\LoginController@logout')->name('logout');

Route::post('save-get-call-request', 'HomeController@saveGetCallRequest')->name('saveGetCallRequest');

Route::post('/check-user-email', 'HomeController@checkUserEmail')->name('checkUserEmail');
Route::post('/check-user-mobile', 'HomeController@checkUserMobile')->name('checkUserMobile');
Route::post('/check-city-name', 'HomeController@getCityName')->name('getCityName');
Route::post('/get-state-list', 'HomeController@getStateList')->name('getStateList');
Route::post('/get-city-list', 'HomeController@getCityList')->name('getCityList');

Route::get('lang/{locale}', 'HomeController@lang');

Route::get('/edit-pdf', 'HomeController@editPdf')->name('editPdf');

Route::get('/terms-and-privacy', 'HomeController@termsAndPrivacy')->name('termsAndPrivacy');
Route::get('/privacy-policy', 'HomeController@privacyPolicy')->name('privacyPolicy');



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
	Route::get('/delete-user/{role_id}/{id}', 'UserController@deleteUser')->name('deleteUser');
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

	//My Leads
	Route::get('/get-call-center-leads', 'CallCenterController@getMyLeads')->name('callcenter.getMyLeads');	

	//Get call request
	Route::match(['get','post'],'/get-call-request', 'CallRequestController@getCallRequest')->name('callcenter.getCallRequest');

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

	//My Leads
	Route::get('/get-lead-assistant-leads', 'LeadAssistantController@getMyLeads')->name('lead_assistant.getMyLeads');

	//Get call request
	Route::get('/get-lead-request', 'LeadRequestController@getLeadRequest')->name('lead_assistant.getLeadRequest');

	Route::get('/presentation/image_one/{id}', 'PresentationController@imageOne')->name('imageOne');
	Route::get('/presentation/image_two/{id}', 'PresentationController@imageTwo')->name('imageTwo');
	Route::get('/presentation/image_three/{id}', 'PresentationController@imageThree')->name('imageThree');
	Route::get('/presentation/image_four/{id}', 'PresentationController@imageFour')->name('imageFour');
	Route::get('/presentation/image_five/{id}', 'PresentationController@imageFive')->name('imageFive');
	Route::get('/presentation/image_six/{id}', 'PresentationController@imageSix')->name('imageSix');
	Route::get('/presentation/form_one/{id}', 'PresentationController@formOne')->name('formOne');
	Route::get('/presentation/form_two/{id}', 'PresentationController@formTwo')->name('formTwo');
	Route::get('/presentation/form_three/{id}', 'PresentationController@formThree')->name('formThree');
	Route::get('/presentation/form_four/{id}', 'PresentationController@formFour')->name('formFour');
	Route::get('/presentation/form_five/{id}', 'PresentationController@formFive')->name('formFive');
	Route::post('/presentation/save_form_one', 'PresentationController@saveFormOne')->name('saveFormOne');
	Route::post('/presentation/save_form_two', 'PresentationController@saveFormTwo')->name('saveFormTwo');
	Route::post('/presentation/save_form_three', 'PresentationController@saveFormThree')->name('saveFormThree');
	Route::post('/presentation/save_form_four', 'PresentationController@saveFormFour')->name('saveFormFour');
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

	//My Leads
	Route::get('/get-tech-partner-leads', 'TechPartnerController@getMyLeads')->name('tech_partner.getMyLeads');

});

Route::group(['prefix' => 'retailer', 'namespace' => 'Retailer'], function () {

	// Authentication Routes...
	Route::get('login', 'Auth\LoginController@showLoginForm')->name('retailer.login');
	Route::post('login', 'Auth\LoginController@login')->name('retailer.postlogin');
	Route::get('logout', 'Auth\LoginController@logout')->name('retailer.logout');

	// Registration Routes...
	Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('retailer.register');
	Route::post('register', 'Auth\RegisterController@register')->name('retailer.postregister');;

	// Password Reset Routes...
	Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('retailer.auth.password.reset');
	Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('retailer.passwordemail');
	Route::get('password/reset/{token?}', 'Auth\ResetPasswordController@showResetForm')->name('retailer.auth.password.reset');
	Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('retailer.resetpassword');

	//Dashboard Route....
	Route::get('/', 'RetailerController@index')->name('retailer.dashboard');
	Route::get('/change-password', 'RetailerController@changePassword')->name('retailer.changePassoword');
	Route::post('/update-password', 'RetailerController@updatePassword')->name('retailer.updatePassword');

	//My Leads
	Route::get('/get-retailer-leads', 'RetailerController@getMyLeads')->name('retailer.getMyLeads');

});



