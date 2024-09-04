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


Route::get('/',[HomeController::class,'index'])->name('client.index');

Route::prefix('kenh-nguoi-ban')->group(function(){
    Route::get('/',[DashBoardController::class,'index'])->name('seller.index');

    Route::get('/them-san-pham',[ProductController::class,'store'])->name('seller.product.store');

    Route::get('/dang-ky-nguoi-ban',[RegisterTrationController::class,'index'])->name('seller.register.index');

    Route::get('/dang-ky',[RegisterTrationController::class,'form'])->name('seller.register.form');

    Route::post('dang-ky-submit', [RegisterTrationController::class, 'store'])->name('seller.register.store');

    Route::get('/get-subCategory',[ProductController::class,'getSubCategory'])->name('seller.getSubCategory');

});


// Route  Account

Route::get('/dang-nhap',[AccountController::class,'index'])->name('account.login');

Route::post('/dang-nhap/authenticate',[AccountController::class,'authenticate'])->name('account.authenticate');

Route::get('/dang-ky',[AccountController::class,'register'])->name('account.register');

Route::post('/dang-ky/processRegiter',[AccountController::class,'processRegister'])->name('account.processRegister');

Route::get('/xac-thuc-tai-khoan',[OTPController::class,'index'])->name('otp.index');

Route::get('/xac-thuc-tai-khoan/send-otp',[OTPController::class,'sendOTP'])->name('otp.sendOTP');

Route::post('/xac-thuc-tai-khoan/otp',[OTPController::class,'verifyOTP'])->name('otp.verifyOTP');







// End Route Account