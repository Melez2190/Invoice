<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\EmpController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\ItemsController;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\DynamicPdfController;


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

Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/clients', [\App\Http\Controllers\ClientsController::class, 'index'])->name('index');
Route::get('/clients/create', [\App\Http\Controllers\ClientsController::class, 'create'])->name('create');
Route::post('/clients/store', [\App\Http\Controllers\ClientsController::class, 'store'])->name('store');
Route::get('/clients/{id}/edit', [\App\Http\Controllers\ClientsController::class, 'edit']);
Route::post('/clients/update/{id}', [\App\Http\Controllers\ClientsController::class, 'update'])->name('update');
Route::get('/clients/search', [\App\Http\Controllers\ClientsController::class, 'index'])->name('index');
Route::get('/clients/{id}',  [\App\Http\Controllers\ClientsController::class, 'show']);


Route::get('/invoices', [\App\Http\Controllers\InvoicesController::class, 'index'])->name('index');
Route::get('/invoices/create', [\App\Http\Controllers\InvoicesController::class, 'create'])->name('create');
Route::post('/invoices/store', [\App\Http\Controllers\InvoicesController::class, 'store'])->name('store');
Route::get('/invoices/{id}/edit', [\App\Http\Controllers\InvoicesController::class, 'edit']);
Route::post('/invoices/update/{id}', [\App\Http\Controllers\InvoicesController::class, 'update']);
Route::get('/invoices/search', [\App\Http\Controllers\InvoicesController::class, 'index'])->name('index');
Route::get('/invoices/{id}', [\App\Http\Controllers\InvoicesController::class, 'show']);

Route::get('/items/create', [\App\Http\Controllers\ItemsController::class, 'create'])->name('create');
Route::post('/items/store', [\App\Http\Controllers\ItemsController::class, 'store'])->name('store');


Route::get('/pdf', [\App\Http\Controllers\DynamicPdfController::class, 'index'])->name('index');
Route::get('/pdf/{id}', [\App\Http\Controllers\DynamicPdfController::class, 'show']);

Route::get('/download-pdf/{invoice}', [\App\Http\Controllers\DynamicPdfController::class, 'pdf']);




 