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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/sinh-vien','App\Http\Controllers\UserController@index')->name('users.index');
Route::get('/sinh-vien/them','App\Http\Controllers\UserController@create')->name('users.create');
Route::post('/sinh-vien/them','App\Http\Controllers\UserController@store')->name('users.store');
Route::get('/sinh-vien/{id}/sua','App\Http\Controllers\UserController@edit')->name('users.edit');
Route::post('/sinh-vien/{id}/sua','App\Http\Controllers\UserController@update')->name('users.update');
Route::get('/sinh-vien/{id}/xóa','App\Http\Controllers\UserController@destroy')->name('users.destroy');

