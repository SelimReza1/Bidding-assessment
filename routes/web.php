<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\User\BiddingSessionController;
use App\Http\Controllers\User\HomeController as UserHomeController;
use App\Http\Controllers\User\ProductController as UserProductController;

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

Route::get('/', [HomeController::class, 'index']);

Route::middleware('guest')->group(function () {
    Route::get('/admin/login', [AdminLoginController::class, 'index'])->name('admin.login');
    Route::post('/admin/login', [AdminLoginController::class, 'login'])->name('admin.login.post');
});

Route::get('/user', [BiddingSessionController::class, 'index'])->name('user.bidding_session.index');
Route::post('/user', [BiddingSessionController::class, 'sendMagicLink'])->name('user.bidding_session.send_magic_link');

Route::get('/verify_code/{code}', [BiddingSessionController::class, 'verifyCode']);

Route::middleware('auth_bidder')->group(function () {
    Route::get('/user/home', [UserHomeController::class, 'index'])->name('user.home');

    Route::get('/user/products/{product}', [UserProductController::class, 'show'])
        ->name('user.product.show');

    Route::post('/user/product/{product}', [UserProductController::class, 'placeBid'])
        ->name("user.product.bid");
});

/**
 * These routes are for admin
 * */
Route::middleware('auth')->group(function () {
    Route::get('/admin', [AdminHomeController::class, 'index'])->name('admin.home');

    Route::get('/admin/products/create', [ProductController::class, 'create'])
        ->name('admin.products.create');
    Route::post('/admin/products', [ProductController::class, 'store'])
        ->name('admin.products.store');
});
