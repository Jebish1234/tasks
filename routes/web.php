<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Product;

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


Route::prefix('admin')->group(function() {
    
    Route::get('/', [\App\Http\Controllers\ProductController::class, 'index'])->name('index');
    Route::get('/create', [\App\Http\Controllers\ProductController::class, 'create'])->name('create');
    Route::get('/show/{id}', [\App\Http\Controllers\ProductController::class, 'show'])->name('show');
    Route::get('/edit/{id}', [\App\Http\Controllers\ProductController::class, 'edit'])->name('edit');
    Route::post('/update/{id}', [\App\Http\Controllers\ProductController::class, 'update'])->name('update');
    Route::post('/store', [\App\Http\Controllers\ProductController::class, 'store'])->name('store');
    Route::post('/delete/{id}', [\App\Http\Controllers\ProductController::class, 'destroy'])->name('delete');
    Route::get('/admin-orders', [\App\Http\Controllers\Auth\AuthController::class, 'adminorder'])->name('admin-orders');

   }) ;

   Route::get('login', [\App\Http\Controllers\Auth\AuthController::class, 'index'])->name('login');
    Route::post('post-login', [\App\Http\Controllers\Auth\AuthController::class, 'postLogin'])->name('login.post'); 
    Route::get('registration', [\App\Http\Controllers\Auth\AuthController::class, 'registration'])->name('register');
    Route::post('post-registration', [\App\Http\Controllers\Auth\AuthController::class, 'postRegistration'])->name('register.post'); 
    Route::get('dashboard', [\App\Http\Controllers\Auth\AuthController::class, 'dashboard']); 
    Route::get('logout', [\App\Http\Controllers\Auth\AuthController::class, 'logout'])->name('logout');
    Route::get('/cart/{id}', [\App\Http\Controllers\Auth\AuthController::class, 'cart'])->name('cart');
    Route::get('/order/{id}', [\App\Http\Controllers\Auth\AuthController::class, 'order'])->name('order');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
