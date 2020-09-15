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
    Route::get('/preview', 'ApplicationController@applicationPreview')->name('preview');
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

