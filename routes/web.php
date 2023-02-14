<?php

use App\Models\Application;
use Illuminate\Support\Arr;
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
//https://onlinehtmleditor.dev/
Route::group(['prefix' => 'selected', 'as' => 'web.'], function () {
    Route::get('/institutions', 'DashboardController@application')->name('selected-institutions');
    Route::get('/labs', 'DashboardController@ownLabs')->name('selected-labs');
});

Route::get('/about', 'DashboardController@getAbout')->name('about');

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('applications.dashboard');
    }
    return redirect('/');
});
Route::get('/', 'DashboardController@getHome')->name('home');
Route::get('/fantasy', 'FantasyController@index')->name('fantasy');
Route::get('/fantasy/{event}/teams', 'FantasyController@teams')->name('fantasyTeams');
Route::get('/fantasy/login', 'FantasyController@login')->name('fantasylogin');

//Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
Auth::routes(['register' => false, 'verify' => true]);
//Route::get('/{application}', 'ApplicationController@show')->name('show');
Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', 'DashboardController@index')->name('applications.dashboard');
});
Route::group(['prefix' => 'admin/applications', 'as' => 'applications.','middleware' => 'auth'], function () {
    Route::get('/', 'ApplicationController@index')->name('index');
    Route::get('/terms', 'ApplicationController@terms')->name('terms');
    Route::get('/apply', 'ApplicationController@create')->name('apply');
    Route::get('/eiin', 'ApplicationController@getValuesByEiin')->name('eiin');
    Route::post('/store', 'ApplicationController@store')->name('store');;
    Route::get('/send_applications', 'ApplicationUpdateController@getApplicationStats')->name('stat');
    Route::patch('/send-applications', 'ApplicationUpdateController@sendApplications')->name('send');
    Route::patch('/sendback-applications', 'ApplicationUpdateController@sendbackApplications')->name('sendback');
    Route::get('{application}/verify', 'ApplicationUpdateController@edit')->name('edit');
    Route::put('{application}', 'ApplicationUpdateController@updates')->name('updates');
    Route::get('{id}/attachment/{path}', 'ApplicationController@displayPdf')->name('displayPdf');
    Route::get('/sms', 'ApplicationController@sms')->name('sms');;
    Route::get('/{application}', 'ApplicationController@show')->name('show');
    Route::patch('/{application}/app_district_verification', 'ApplicationUpdateController@postAppDistrictVerification')->name('appDistrictVerification');
    Route::get('/{application}/duplicate', 'ApplicationUpdateController@getDuplicate')->name('duplicate');
    Route::patch('/{application}/duplicate', 'ApplicationUpdateController@postDuplicate')->name('postDuplicate');
    Route::post('/update/{application}', 'ApplicationController@update')->name('update');
});

Route::group(['prefix' => 'admin/labs', 'as' => 'labs.','middleware' => 'auth'], function () {
    Route::get('{labId}/trainees', 'TraineeController@edit')->name('trainees.edit');
    Route::patch('{labId}/trainees', 'TraineeController@update')->name('trainees.update');
    //Route::resource('stocks', 'StockController');
   // Route::get('/stocks', 'StockController@index')->name('stocks.index');
    Route::get('/stocks', 'StockController@stocks')->name('stocks.index');
    /*Route::get('{labId}/stocks/{stockId}', 'StockController@show')->name('stocks.show');*/
    //Route::get('{labId}/stocks/create', 'StockController@create')->name('stocks.create');
    //Route::post('{labId}/stocks/store', 'StockController@store')->name('stocks.store');
    Route::get('{labId}/stocks/{stockId}/edit', 'StockController@edit')->name('stocks.edit');
    Route::patch('{labId}/stocks/{stockId}', 'StockController@update')->name('stocks.update');

    Route::get('{labId}/supports', 'SupportController@supports')->name('supports.index');
    Route::get('tickets', 'SupportController@tickets')->name('tickets.index');
    Route::get('tickets/{ticketId}', 'SupportController@ticket')->name('tickets.show');
    Route::post('{labId}/supports/store', 'SupportController@store')->name('tickets.store');
    Route::get('{labId}/supports/{id}/edit', 'SupportController@edit')->name('tickets.edit');
    Route::get('image/{filename}', 'SupportController@displayImage')->name('displayImage');
});


Route::group(['prefix' => 'admin/download_print', 'as' => 'applications.','middleware' => 'auth'], function () {
    Route::get('/applications', 'ApplicationController@application')->name('download');
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
Route::get('/{application}/verification-form','TestController@createPdf')->name('loadpdf');
Route::get('update-pdf','TestController@updatePdf')->name('downloadpdf');

Route::get('/clear', function() {

    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    \Artisan::call('route:cache');
    Artisan::call('route:clear');
    \Artisan::call('optimize:clear');
    return "Cleared!";

});

Route::get('/empty-reserved', function() {
    $reserved_seats=[];
   $reserved_seats_entered= Application::whereLike('parliamentary_constituency','মহিলা আসন-')->groupBy('seat_no')->get('seat_no')->toArray();
   foreach ($reserved_seats_entered as $res_en){
       $reserved_seats[]= $res_en['seat_no'];
   }
   //dd($reserved_seats);
   $all_reserved= ReservedSeats();
   $empty_seats=[];
   foreach ($all_reserved as $all_res){

       if(!in_array($all_res['seat_no'],$reserved_seats)){
           $empty_seats[]= $all_res;
       }
   }

    return ($empty_seats);

});


Route::resource('notices', 'NoticeController');
Route::get('notices/{id}/{path}', 'NoticeController@displayPdf')->name('displayPdf');
Route::get('notice-attachments', 'NoticeController@notices')->name('notice.attachments');

Route::get('pdfs/{pdf}', 'DashboardController@showPdf')->name('showPdf');
