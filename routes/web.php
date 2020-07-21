<?php

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
    return view('welcome');
});



Route::group(['prefix' => 'applications', 'as' => 'applications.'], function () {

    Route::get('/terms', 'ApplicationController@terms')->name('terms');
    Route::get('/apply', 'ApplicationController@create')->name('apply');
    Route::post('/store', 'ApplicationController@store')->name('store');;

});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/divisions', 'AreaController@getDivisions')->name('divisions');
Route::get('/districts', 'AreaController@getDistricts')->name('districts');
Route::get('/upazilas', 'AreaController@getUpazilas')->name('upazilas');
