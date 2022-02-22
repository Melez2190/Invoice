<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ClientsController;

use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MailController;


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
    return view('home');
})->middleware('auth');

Auth::routes();

Route::get('dev-login', [LoginController::class, 'devLogin'])->name('dev-login');
Route::post('/invoices/archive/{id}', [InvoicesController::class, 'archiveDeleted'])->middleware('auth');
Route::delete('/item/delete/{id}', [\App\Http\Controllers\ItemsController::class, 'delete'])->name('item.delete')->middleware('auth');
Route::get('/items/restore/{id}', [\App\Http\Controllers\ItemsController::class, 'restore'])->name('items.restore')->middleware('auth');





Route::group(['middleware' => 'auth'], function() {
    Route::resource('clients'   , '\App\Http\Controllers\ClientsController');
    Route::resource('invoices'  , '\App\Http\Controllers\InvoicesController');
    Route::resource('items'     , '\App\Http\Controllers\ItemsController');

});



Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');


// Route::get('/clients', [\App\Http\Controllers\ClientsController::class, 'index'])->name('index')->middleware('auth');
// Route::get('/clients/create', [\App\Http\Controllers\ClientsController::class, 'create'])->name('create')->middleware('auth');
// Route::post('/clients/store', [\App\Http\Controllers\ClientsController::class, 'store'])->name('store')->middleware('auth');
// Route::get('/clients/{id}/edit', [\App\Http\Controllers\ClientsController::class, 'edit'])->middleware('auth');
// Route::post('/clients/update/{id}', [\App\Http\Controllers\ClientsController::class, 'update'])->name('update')->middleware('auth');
// Route::get('/clients/search', [\App\Http\Controllers\ClientsController::class, 'index'])->name('index')->middleware('auth');
// Route::get('/clients/{id}',  [\App\Http\Controllers\ClientsController::class, 'show'])->middleware('auth');
// Route::post('/clients/delete/{client}', [ClientsController::class, 'destroy'])->name('destroy')->middleware('auth');


// Route::get('/invoices', [\App\Http\Controllers\InvoicesController::class, 'index'])->name('index')->middleware('auth');
// Route::get('/invoices/create', [\App\Http\Controllers\InvoicesController::class, 'create'])->name('create')->middleware('auth');
// Route::post('/invoices/store', [\App\Http\Controllers\InvoicesController::class, 'store'])->name('store')->middleware('auth');
// Route::get('/invoices/{id}/edit', [\App\Http\Controllers\InvoicesController::class, 'edit'])->middleware('auth');
// Route::post('/invoices/update/{id}', [\App\Http\Controllers\InvoicesController::class, 'update'])->middleware('auth');
// Route::get('/invoices/search', [\App\Http\Controllers\InvoicesController::class, 'index'])->name('index')->middleware('auth');
// Route::get('/invoices/{id}', [\App\Http\Controllers\InvoicesController::class, 'show'])->name('invoice.show')->middleware('auth');
// Route::post('/invoice/delete/{client}', [InvoicesController::class, 'destroy'])->name('destroy')->middleware('auth');


// Route::get('/items/create', [\App\Http\Controllers\ItemsController::class, 'create'])->name('create')->middleware('auth');
// Route::post('/items/store', [\App\Http\Controllers\ItemsController::class, 'store'])->name('store')->middleware('auth');
// Route::get('/items/{id}/edit', [\App\Http\Controllers\ItemsController::class, 'edit'])->middleware('auth');
// Route::post('/items/update/{id}', [\App\Http\Controllers\ItemsController::class, 'update'])->middleware('auth');

Route::get('/user/statistics', [UserController::class, 'stats'])->middleware('auth');
Route::get('/user/stats', [\App\Http\Controllers\UserController::class, 'stats'])->middleware('auth');

Route::get('/send-email/{invoice}', [MailController::class, 'sendEmail'])->middleware('auth');






Route::get('/pdf', [\App\Http\Controllers\DynamicPdfController::class, 'index'])->name('index');
Route::get('/pdf/{id}', [\App\Http\Controllers\DynamicPdfController::class, 'show']);

Route::get('/download-pdf/{invoice}', [\App\Http\Controllers\DynamicPdfController::class, 'pdf']);




 