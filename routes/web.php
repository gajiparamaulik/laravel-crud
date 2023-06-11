<?php

use App\Http\Controllers\MailController;
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

// Route::resource('/products', ProductController::class)->middleware(['auth']);

Route::controller(ProductController::class)->group(function(){
    Route::get('products', 'index')->name('products.index');
    Route::post('products', 'store')->name('products.store');
    Route::get('products-edit/{id}', 'edit')->name('products.edit');
    Route::put('products-update', 'update')->name('products.update');
    Route::delete('products/{item}', 'destroy')->name('products.delete');
});



Route::get('/send-mail', [MailController::class, 'index']);

Route::get('user_details', [App\Http\Controllers\LocationController::class, 'userDetails']);