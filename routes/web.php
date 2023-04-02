<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MainDashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Auth routes
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'save'])->name('save');
// Home routes
Route::get('/', [HomeController::class, 'index'])->name('home.index');
// Cart routes
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.addToCart');
Route::post('/cart/update', [CartController::class, 'updateCart'])->name('cart.updateCart');
Route::get('/cart/count', [CartController::class, 'cartCount'])->name('cart.cartCount');
Route::delete('/cart/{id}', [CartController::class, 'deleteCart'])->name('cart.deleteCart');
Route::post('/cart/deleteall', [CartController::class, 'deleteAllCart'])->name('cart.deleteAllCart');

// invoice
Route::get('/checkout', [InvoiceController::class, 'checkout'])->name('invoice.checkout');
Route::post('/checkout', [InvoiceController::class, 'save'])->name('invoice.checkout');
Route::get('/checkout/success', [InvoiceController::class, 'success'])->name('invoice.success');
// login authenticated routes
Route::group(['middleware' => ['auth']], function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::group(['prefix' => 'dashboard'], function () {
        Route::get('/invoice', [InvoiceController::class, 'index'])->name('invoice.index');
        Route::get('/', [MainDashboardController::class, 'index'])->name('dashboard.index');
        Route::get('/profile/{id}', [MainDashboardController::class, 'showProfile'])->name('dashboard.profile');
        Route::group(['prefix' => 'user'], function () {
            Route::get('/', [UserController::class, 'index']);
            Route::delete('/{id}', [UserController::class, 'delete']);
            Route::get('/{id}', [UserController::class, 'get']);
            Route::post('/', [UserController::class, 'create']);
            Route::put('/{id}', [UserController::class, 'update']);
            Route::put('/active/{id}', [UserController::class, 'activeUser']);
        });
        Route::group(['prefix' => 'category'], function () {
            Route::get('/', [CategoryController::class, 'index']);
            Route::delete('/{id}', [CategoryController::class, 'delete']);
            Route::put('/{id}', [CategoryController::class, 'update']);
            Route::get('/{id}', [CategoryController::class, 'get']);
            Route::post('/', [CategoryController::class, 'create']);
        });
        Route::group(['prefix' => 'product'], function () {
            Route::get('/', [ProductController::class, 'index'])->name('product.index');
            Route::get('/edit/{id}', [ProductController::class, 'edit']);
            Route::delete('/{id}', [ProductController::class, 'delete']);
            Route::post('/edit/{id}', [ProductController::class, 'update']);
            Route::get('/create', [ProductController::class, 'create']);
            Route::post('/create/store', [ProductController::class, 'store']);
        });
    });
});