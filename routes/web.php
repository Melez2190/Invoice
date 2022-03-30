<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ClientsController;

use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\TenantController;

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
Route::get('dev-login', [LoginController::class, 'devLogin'])->name('dev-login');
Route::get('invoices/updateStatus', [InvoicesController::class, 'changeStatus'])->name('invoice.changestatus');
Route::post('/getInvoices', [InvoicesController::class, 'getInvoicesClient'])->name('getInvoicesClient');





Route::group(['middleware' => 'auth'], function() {
    Route::group(['middleware' => 'checkAdmin'], function() {
        Route::resource('admin/tenants', TenantController::class);
    
    });

    Route::get('setpassword', [\App\Http\Controllers\SetPasswordController::class, 'create'])->name('setpassword');
    Route::post('setpassword', [\App\Http\Controllers\SetPasswordController::class, 'store'])->name('setpassword.store');

    Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::post('/invoices/archive/{id}', [InvoicesController::class, 'archiveDeleted']);
    Route::delete('/item/delete/{item}', [\App\Http\Controllers\ItemsController::class, 'delete'])->name('item.delete');
    Route::get('/items/restore/{id}', [\App\Http\Controllers\ItemsController::class, 'restore'])->name('items.restore');
    Route::get('/user/statistics', [UserController::class, 'stats']);
    Route::get('/user/stats', [\App\Http\Controllers\UserController::class, 'stats']);

    Route::resource('clients'   , '\App\Http\Controllers\ClientsController');
    Route::resource('invoices'  , '\App\Http\Controllers\InvoicesController');
    Route::resource('items'     , '\App\Http\Controllers\ItemsController');

   
    Route::get('/send-email/{invoice}', [MailController::class, 'sendEmail']);

    Route::get('/pdf', [\App\Http\Controllers\DynamicPdfController::class, 'index'])->name('index');
    Route::get('/pdf/{id}', [\App\Http\Controllers\DynamicPdfController::class, 'show']);

    Route::get('/download-pdf/{invoice}', [\App\Http\Controllers\DynamicPdfController::class, 'pdf'])->name('pdf.receipt');
});

Route::get('invitation/{user}', [\App\Http\Controllers\TenantController::class, 'invitation'])->name('invitation');




