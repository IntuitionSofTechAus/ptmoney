<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
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

Route::get('/admin',[AdminController::class,'index'])->name('admin.dashboard')->middleware('auth');
Auth::routes();
Route::group(['prefix' =>'admin', 'middleware' => 'auth'], function(){
 Route::get('/payment',[AdminController::class,'paymentList'])->name('payment.list');
 Route::get('/procesing',[AdminController::class,'procesingList'])->name('procesing.list');   
 Route::get('/transferring',[AdminController::class,'transferring'])->name('transferring');  
 Route::get('/completed',[AdminController::class,'completedList'])->name('completed.list');
 Route::get('/member',[AdminController::class,'memberList'])->name('member.list');
 Route::get('/showmember/{id}',[AdminController::class,'showMember'])->name('showmember'); 
 Route::get('/edit-member/{id}',[AdminController::class,'editMember'])->name('edit.member'); 
 
 Route::get('/transaction',[AdminController::class,'addTransaction'])->name('transaction.add');
 Route::any('/exchange-rate',[AdminController::class,'exchangeRate'])->name('exchange.rate');
 Route::any('/setting',[AdminController::class,'setting'])->name('admin.setting');
 Route::post('/approval',[AdminController::class,'approval'])->name('approval');   
 Route::get('/users-list',[AdminController::class,'usersList'])->name('users.list');

 Route::get('/list-customer',[AdminController::class,'listCustomer'])->name('customer.list');

 Route::get('/list-transaction',[AdminController::class,'listTransaction'])->name('transaction.list');
 Route::get('/list-transaction/{status}',[AdminController::class,'listTransactionByStatus'])->name('transaction.status');
 
 Route::get('/new-customer',[AdminController::class,'newCustomer'])->name('customer.new');

 Route::get('/new-transaction/{id}',[AdminController::class,'newTransaction'])->name('transaction.new');

 Route::get('/new-transaction',[AdminController::class,'addNewTransaction'])->name('new-transaction');
 Route::get('/view-transaction/{id}',[AdminController::class,'viewTransaction'])->name('transaction.view');

 Route::get('/show-customer/{id}',[AdminController::class,'showCustomer'])->name('showcustomer');
 Route::get('/receivers-list/{id}',[AdminController::class,'receiversList'])->name('show.receivers');

 Route::get('beneficiary-form/{id}',[AdminController::class,'addbeneficiary'])->name('beneficiary.adminadd');
 Route::post('add-customer',[AdminController::class,'store'])->name('customer.store');

 Route::post('add-transaction',[AdminController::class,'transactionStore'])->name('transaction.store');   

 Route::post('update-transaction',[AdminController::class,'transactionUpdate'])->name('transaction.update');   

 Route::get('/edit-transaction/{id}',[AdminController::class,'editTransaction'])->name('transaction.edit');

 Route::get('/mail-transaction/{id}',[AdminController::class,'sendTransactionMail'])->name('transaction.mail');

 Route::post('/export', [AdminController::class, 'exportTransaction'])->name('transaction.export');

});
 
