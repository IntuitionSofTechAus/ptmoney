<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PageController;
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

Route::get('/',[PageController::class,'home']);
Route::get('terms-and-condition', function () {
    return view('member.terms_and_condition');
});
Route::get('/test-mail',function(){
	$to = "test@mailinator.com";
	$subject = "test mail";
	$test = ['test'];
	Mail::send('emails.test', ['test'=>$test], function($message) use ($to, $subject){
		$message->from('planiteach@gmail.com', "PlanITeach");
		$message->subject($subject);
		$message->to($to);                
	});
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');
Route::get('/user/verify/{token}/{id}', 'App\Http\Controllers\Auth\RegisterController@verifyUser')->name('user.verify');
Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', [ProfileController::class,'edit'])->name('profile.edit');
	Route::put('profile', [ProfileController::class,'update'])->name('profile.update');
	Route::put('profile/password',[ProfileController::class,'password'])->name('profile.password');
	Route::get('aplicatoion-form',[MemberController::class,'index'])->name('aplication-form');
	Route::post('member/store',[MemberController::class,'store'])->name('member.store');
});
Route::group(['middleware' => 'auth'], function () {
	Route::get('{page}', ['as' => 'page.index', 'uses' => 'App\Http\Controllers\PageController@index']);
});

