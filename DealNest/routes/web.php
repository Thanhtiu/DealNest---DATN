<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Sellers\RegisterTrationController;
use App\Http\Controllers\Sellers\ProductController;
use App\Http\Controllers\Sellers\DashBoardController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\ProductDetailController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\CategoryController;



Route::get('/', [HomeController::class, 'index'])->name('client.index');
// test giao diện
Route::get('/san-pham-chi-tiet/{id}', [ProductDetailController::class, 'index'])->name('client.productDetail');
Route::get('/gio-hang', [CartController::class, 'index'])->name('client.cart');
Route::get('/the-loai', [CategoryController::class, 'index']);
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
Route::get('/cua-hang', [HomeController::class, 'shop']);

Route::prefix('/tai-khoan-cua-toi')->group(function () {
    Route::get('/ho-so', [HomeController::class, 'profile'])->name('acccount.profile');
    Route::get('/dia-chi', [HomeController::class, 'adress']);
    Route::get('/voucher', [HomeController::class, 'voucher']);

});

Route::group(['prefix' => 'tai-khoan'], function () {
    Route::get('/dang-nhap', [AccountController::class, 'index'])->name('account.login');
    Route::post('/dang-nhap/authenticate', [AccountController::class, 'authenticate'])->name('account.authenticate');
    Route::get('/dang-ky', [AccountController::class, 'register'])->name('account.register');
    Route::post('/dang-ky/processRegiter', [AccountController::class, 'processRegister'])->name('account.processRegister');

    // Route  Account
    Route::get('/xac-thuc', [OTPController::class, 'index'])->name('otp.index');
    Route::get('/xac-thuc/send-otp', [OTPController::class, 'sendOTP'])->name('otp.sendOTP');
    Route::post('/xac-thuc/otp', [OTPController::class, 'verifyOTP'])->name('otp.verifyOTP');
    // End Route Account
});

// Middleware
Route::group(['middleware' => 'auth'], function () {
    Route::get('tai-khoan/dang-xuat', [AccountController::class, 'logout'])->name('account.logout');
    // Seller Route
    Route::prefix('kenh-nguoi-ban')->group(function () {
        Route::get('/', [DashBoardController::class, 'index'])->name('seller.index');

        Route::post('dang-ky-submit', [RegisterTrationController::class, 'store'])->name('seller.register.store');

        Route::get('/them-san-pham', [ProductController::class, 'store'])->name('seller.product.store');

        Route::get('/dang-ky-nguoi-ban', [RegisterTrationController::class, 'index'])->name('seller.register.index');

        Route::get('/dang-ky', [RegisterTrationController::class, 'form'])->name('seller.register.form');

        Route::get('/get-subCategory', [ProductController::class, 'getSubCategory'])->name('seller.getSubCategory');

        Route::post('/them-san-pham/submit', [ProductController::class, 'create'])->name('seller.product.create');

        Route::get('/danh-sach-san-pham', [ProductController::class, 'list'])->name('seller.product.list');

        Route::get('/sua-san-pham/{id}', [ProductController::class, 'edit'])->name('seller.product.edit');

        Route::put('/cap-nhat-san-pham/{id}', [ProductController::class, 'update'])->name('seller.product.update');

        Route::get('/xoa-san-pham/{id}', [ProductController::class, 'delete'])->name('seller.product.delete');


    });

    // End Seller Route
});
