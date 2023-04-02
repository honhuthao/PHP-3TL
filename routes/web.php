<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MainDashboardController;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'save'])->name('save');
// login authenticated routes
Route::group(['middleware' => ['auth']], function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::group(['prefix' => 'dashboard'], function () {
        Route::get('/', [MainDashboardController::class, 'index'])->name('dashboard.index');
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