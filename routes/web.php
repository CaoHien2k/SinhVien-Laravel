<?php

use App\Http\Controllers\PaypalController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('users', UserController::class);
Route::get('/users/{id}/show-subject','App\Http\Controllers\UserController@showSubject')->name('users.showSubject');
Route::get('/users/{id}/show-profile','App\Http\Controllers\UserController@showProfile')->name('users.showProfile');


Route::get('auth/google', 'App\Http\Controllers\Auth\LoginController@redirectToGoogle');
Route::get('auth/google/callback', 'App\Http\Controllers\Auth\LoginController@handleGoogleCallback');

Route::get('paypal', [PaypalController::class, 'index']);

// Route::get('auth/facebook', 'Auth\FacebookController@redirectToFacebook');
// Route::get('auth/facebook/callback', 'Auth\FacebookController@handleFacebookCallback');


Route::get('email-test', function(){
  
	$details['email'] = 'caohien0503@gmail.com';
  
    dispatch(new App\Jobs\SendEmailJob($details));
  
    dd('done');
});


Route::get('importExportView', 'App\Http\Controllers\UserController@importExportView');
Route::get('export', 'App\Http\Controllers\UserController@export')->name('export');
Route::post('import', 'App\Http\Controllers\UserController@import')->name('import');
Route::get('send', 'App\Http\Controllers\UserController@sendNotification');
Route::get('pdf','App\Http\Controllers\UserController@generatePDF');

Route::get('/chatbot', function () {
    return view('chatbot');
});
Route::match(['get', 'post'], '/botman', 'App\Http\Controllers\BotManController@handle');