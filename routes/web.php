<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('homepage');
});



Route::group(['prefix' => 'applications', 'as' => 'applications.'], function () {

    Route::get('/terms', 'ApplicationController@terms')->name('terms');
    Route::get('/apply', 'ApplicationController@create')->name('apply');
    Route::get('/eiin', 'ApplicationController@getValuesByEiin')->name('eiin');
    Route::post('/store', 'ApplicationController@store')->name('store');;
    Route::get('/sms', 'ApplicationController@sms')->name('sms');;

});
Auth::routes();

Route::get('loginWithOtp', function () {
    if (Auth::check()) {
        return redirect('/applications/apply');
    }
    return view('auth/loginWithOtp');
})->name('loginWithOtp');
Route::post('loginWithOtp', 'Auth\LoginController@loginWithOtp')->name('loginWithOtp');
Route::post('sendOtp', 'Auth\LoginController@sendOtp');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/divisions', 'AreaController@getDivisions')->name('divisions');
Route::get('/districts', 'AreaController@getDistricts')->name('districts');
Route::get('/upazilas', 'AreaController@getUpazilas')->name('upazilas');
