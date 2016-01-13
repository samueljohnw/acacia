<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {


Route::get('/','PagesController@index');
Route::get('missionaries',['as'=>'missionaries','uses'=>'PagesController@missionaries']);

// User Protected Routes
Route::group(['middleware' => 'auth'], function () {
    Route::get('dashboard', ['uses'=>'User\DashboardController@dashboard']);
    Route::get('profile', ['uses'=>'User\ProfileController@getIndex']);
    Route::post('profile', ['uses'=>'User\ProfileController@postIndex']);
});

// Admin Protected Routes
Route::group(['prefix'=>'admin','middleware' => 'admin'], function () {
    Route::get('/', ['as'=>'admin.index','uses'=>'Admin\DashboardController@index']);
    Route::resource('users','Admin\UsersController');
    Route::resource('pages','Admin\PagesManagerController');
    Route::post('users/reset-password/{id}',['as'=>'users.reset-password','uses'=>'Admin\UsersController@sendResetRequest']);
    Route::post('add-recipient/{id}', ['as'=>'admin.users.add_recipient','uses'=>'Admin\UsersController@add_recipient']);
    Route::post('verify-recipient/{id}', ['as'=>'admin.users.verify_recipient','uses'=>'Admin\UsersController@verify_recipient']);
    Route::get('transfers/{year?}/{month?}', ['as'=>'admin.transfers.show','uses'=>'Admin\TransferController@show']);
    Route::post('transfer', ['as'=>'admin.transfer','uses'=>'Admin\TransferController@transfer']);
    Route::get('checks', ['as'=>'admin.checks.show','uses'=>'Admin\ChecksController@show']);
    Route::post('checks', ['as'=>'admin.checks.create','uses'=>'Admin\ChecksController@create']);
    Route::get('monthlies', ['as'=>'admin.monthlies.show','uses'=>'Admin\MonthliesController@show']);
    Route::post('monthlies', ['as'=>'admin.monthlies.delete','uses'=>'Admin\MonthliesController@delete']);
    Route::get('applications', ['as'=>'admin.applications.index','uses'=>'Admin\ApplicationsController@index']);
    Route::get('applications/{id}', ['as'=>'admin.applications.show','uses'=>'Admin\ApplicationsController@show']);
});

// Online Application
Route::get('apply',['as'=>'apply','uses'=>'PagesController@apply']);
Route::post('apply',['as'=>'apply.create','uses'=>'PagesController@submit_apply']);


Route::get('contact',['as'=>'contact','uses'=>'PagesController@contact']);
Route::post('contact',['as'=>'contact.post','uses'=>'PagesController@submit_contact']);

// Authentication routes
Route::get('login', ['as'=>'login','uses'=>'Auth\AuthController@getLogin']);
Route::post('login', 'Auth\AuthController@postLogin');
Route::get('logout', 'Auth\AuthController@getLogout');

// Password reset link request routes...
Route::get('password/email/{email?}', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

Route::get('{slug}/give', 'PaymentController@show');
Route::post('give/process/{id}', ['as'=>'process.donation','uses'=>'PaymentController@process']);
Route::post('give/check-request', ['as'=>'check.request','uses'=>'PaymentController@check_request']);
// Route::get('thank-you', ['as'=>'payment.thankyou','uses'=>'PaymentController@thankyou']);

// Webooks
Route::post('webhooks/invoice_failed', 'WebhookController@invoice_failed');
Route::get('m/{slug}', ['as'=>'missionary','uses'=>'PagesController@showProfile']);
Route::get('{slug}', 'Admin\PagesManagerController@show');

});
