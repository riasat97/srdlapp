<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//git diff --name-only 7a2b7bc 3ff7532
//git log --oneline
// add to google webmaster and others
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
//COMPOSER_MEMORY_LIMIT=-1
//https://stackoverflow.com/questions/29893859/laravel-5-login-redirect-to-a-subdomain
//https://laravel-news.com/laravel-auth-redirection
//https://stackoverflow.com/questions/52583886/post-request-in-laravel-error-419-sorry-your-session-419-your-page-has-exp

Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/dashboard');
    }
    return view('auth/login');
});
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
Auth::routes(['register' => false, 'verify' => true]);

Route::group(['prefix' => 'admin/applications', 'as' => 'applications.','middleware' => 'auth'], function () {

    Route::get('/', 'ApplicationController@index')->name('index');
    Route::get('/app', 'ApplicationController@application')->name('application');
    Route::get('/terms', 'ApplicationController@terms')->name('terms');
    Route::get('/apply', 'ApplicationController@create')->name('apply');
    Route::get('/eiin', 'ApplicationController@getValuesByEiin')->name('eiin');
    Route::post('/store', 'ApplicationController@store')->name('store');;
    Route::get('{application}/edit', 'ApplicationUpdateController@edit')->name('edit');
    Route::put('{application}', 'ApplicationUpdateController@updates')->name('updates');
    Route::get('{id}/attachment/{path}', 'ApplicationController@displayPdf')->name('displayPdf');
    Route::get('/sms', 'ApplicationController@sms')->name('sms');;
    Route::get('/{application}', 'ApplicationController@show')->name('show');
    Route::post('/update/{application}', 'ApplicationController@update')->name('update');
});

//Route::domain('{subdomain}.'. env('APP_URL', 'srdl.gov.bd'))->group(function () {
//
//    Route::get('/test', 'TestController@test');
//
//    Route::group(['prefix' => 'admin/applications', 'as' => 'applications.','middleware' => 'auth'], function () {
//
//        Route::get('/', 'ApplicationController@index')->name('index');
//        Route::get('/terms', 'ApplicationController@terms')->name('terms');
//        Route::get('/apply', 'ApplicationController@create')->name('apply');
//        Route::get('/eiin', 'ApplicationController@getValuesByEiin')->name('eiin');
//        Route::post('/store', 'ApplicationController@store')->name('store');;
//        Route::get('{application}/edit', 'ApplicationUpdateController@edit')->name('edit');
//        Route::put('{application}', 'ApplicationUpdateController@updates')->name('updates');
//        Route::get('{id}/attachment/{path}', 'ApplicationController@displayPdf')->name('displayPdf');
//        Route::get('/sms', 'ApplicationController@sms')->name('sms');;
//        Route::get('/preview', 'ApplicationController@applicationPreview')->name('preview');
//        Route::post('/update/{application}', 'ApplicationController@update')->name('update');
//    });
//
//});


//Route::get('loginWithOtp', function () {
//    if (Auth::check()) {
//        return redirect('/applications');
//    }
//    return view('auth/login');
//})->name('loginWithOtp');

Route::post('loginWithOtp', 'Auth\LoginController@loginWithOtp')->name('loginWithOtp');
Route::post('sendOtp', 'Auth\LoginController@sendOtp');

Route::get('/home1', 'HomeController1@index')->name('home1');
Route::get('/computer_labs', 'HomeController@getComputerLabs')->name('computerLabs');
Route::get('/search_labs', 'HomeController@getSearchLabs')->name('searchLabs');

Route::get('/bd/divisions', 'BdController@getDivisions')->name('bddivisions');
Route::get('/bd/districts', 'BdController@getDistricts')->name('bddistricts');
Route::get('/bd/upazilas', 'BdController@getUpazilas')->name('bdupazilas');

Route::get('/divisions', 'BangladeshController@getDivisions')->name('divisions');
Route::get('/districts', 'BangladeshController@getDistricts')->name('districts');
Route::get('/upazilas', 'BangladeshController@getUpazilas')->name('upazilas');
Route::get('/union_pourashava_wards', 'BangladeshController@getUnionPourashavaWards')->name('union_pourashava_wards');
Route::get('/parliamentary_constituencies', 'BangladeshController@getParliamentaryConstituency')->name('parliamentary_constituencies');
Route::get('/reserved_seats', 'BangladeshController@getReservedSeats')->name('reserved_seats');
Route::get('/seat_no', 'BangladeshController@getSeatNo')->name('seat_no');


Route::get('/home', 'HomeController@index')->middleware('verified');
Route::get('/test', 'TestController@test');

Route::group(['prefix' => 'admin', 'as' => '','middleware' => 'auth'], function () {
Route::resource('roles', 'RoleController');
Route::resource('permissions', 'PermissionController');
Route::resource('references', 'ReferenceController');
Route::resource('referenceDesignations', 'ReferenceDesignationController');
Route::get('change-password', 'ChangePasswordController@index')->name('changePassword');
Route::post('change-password', 'ChangePasswordController@store')->name('change.password');
Route::get('users/{id}/profile', 'UserController@edit')->name('users.edit');
Route::patch('users/{id}', 'UserController@update')->name('users.update');

    Route::group(['middleware' =>  ['role:super admin']], function () {
        Route::resource('users', 'UserController')->except(['edit','update']);
    });
});
Route::get('generate-pdf','TestController@generatePDF');

Route::get('create-pdf','TestController@createPdf')->name('loadpdf');








