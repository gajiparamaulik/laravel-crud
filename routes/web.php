<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('ajaxproducts', ProductController::class)->middleware(['auth']);

// new routes datatable db
// Route::get('product-list', [ProductController::class, 'index']);
// Route::get('product-list/{id}/edit', [ProductController::class, 'edit']);
// Route::post('product-list/store', [ProductController::class, 'store']);
// Route::get('product-list/delete/{id}', [ProductController::class, 'destroy']);