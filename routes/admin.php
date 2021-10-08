<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/admin','App\Http\Controllers\AdminController@index')->name('admin.dashboard');

Auth::routes();

Route::group(['prefix' =>'admin', 'middleware' => 'auth'], function(){
 Route::get('/payment','App\Http\Controllers\AdminController@paymentList')->name('payment.list');
 Route::get('/procesing','App\Http\Controllers\AdminController@procesingList')->name('procesing.list');   
 Route::get('/transferring','App\Http\Controllers\AdminController@transferring')->name('transferring');  
 Route::get('/completed','App\Http\Controllers\AdminController@completedList')->name('completed.list');
 Route::get('/exchange','App\Http\Controllers\AdminController@setExchange')->name('exchange.rate');   
 Route::get('/member','App\Http\Controllers\AdminController@memberList')->name('member.list');  
 Route::get('/transaction','App\Http\Controllers\AdminController@addTransaction')->name('transaction.add');          
});

