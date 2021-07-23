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


Auth::routes();
Route::get('/', 'HomeController@welcome')->name('welcome')->middleware('auth');
Route::post('/', 'HomeController@getCarros')->name('store')->middleware('auth');
Route::get('/{id}', 'HomeController@delete')->name('delete')->middleware('auth');
Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
