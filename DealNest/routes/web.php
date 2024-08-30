<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\OTPController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SellerController;



Route::get('/', function () {
    return view('welcome');
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