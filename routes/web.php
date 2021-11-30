<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HelloWorld;
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
Route::get('excel',[HelloWorld::class,'index']);
Route::post('import',[HelloWorld::class,'import'])->name('import');
Route::POST('getdistrict',[HelloWorld::class,'getdistrict'])->name('getdistrict');
Route::POST('geteditdistrict',[HelloWorld::class,'geteditdistrict'])->name('geteditdistrict');

Route::POST('getstate',[HelloWorld::class,'getstate'])->name('getstate');
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

Route::get('get-receiver/{id}',[App\Http\Controllers\HomeController::class, 'getReceiver']);
Route::get('get-receiver-detail/{id}/{value}',[App\Http\Controllers\HomeController::class, 'getReceiverDetail']);
Route::get('get-sender-detail/{id}/{value}',[App\Http\Controllers\HomeController::class, 'getSenderDetail']);

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');
Route::get('/user/verify/{token}/{id}', 'App\Http\Controllers\Auth\RegisterController@verifyUser')->name('user.verify');
Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']])->middleware('auth');
Route::group(['prefix' =>'user', 'middleware' => 'auth'], function(){
	Route::get('/new-transaction/{id}',[AdminController::class,'newTransaction'])->name('transaction.usernew');
 	Route::get('/view-transaction/{id}',[AdminController::class,'viewTransaction'])->name('transaction.userview');
 	Route::get('/new-transaction',[AdminController::class,'addNewTransaction'])->name('new-transaction');

 	Route::get('/detail-transaction/{id}',[AdminController::class,'detailTransaction'])->name('transaction.detail');

	Route::get('profile', [ProfileController::class,'edit'])->name('profile.edit');
	Route::post('uploadprofile', [ProfileController::class,'profile'])->name('uploadprofile');	
	Route::put('profile', [ProfileController::class,'update'])->name('profile.update');
	Route::put('profile/password',[ProfileController::class,'password'])->name('profile.password');
	Route::get('aplication-form',[MemberController::class,'index'])->name('aplication-form');
	Route::post('member/store',[MemberController::class,'store'])->name('member.store');
	Route::post('member/update',[MemberController::class,'update'])->name('member.update');
	Route::post('member/againstore',[MemberController::class,'againstore'])->name('member.againstore');	
	Route::get('/beneficiary',[MemberController::class,'beneficiaryList'])->name('beneficiary.list');
	Route::get('beneficiary-form',[MemberController::class,'beneficiary'])->name('beneficiary.add');
	Route::post('beneficiary/store',[MemberController::class,'beneficiaryStore'])->name('beneficiary.store');
	Route::get('/showbeneficiary/{id?}',[MemberController::class,'showBeneficiary'])->name('showbeneficiary');
});
Route::group(['middleware' => 'auth'], function () {
	Route::get('{page}', ['as' => 'page.index', 'uses' => 'App\Http\Controllers\PageController@index']);
});




