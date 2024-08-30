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

});
