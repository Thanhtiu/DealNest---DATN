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
use App\Http\Controllers\Client\ProfileController;
use App\Http\Controllers\Client\AddressController;
use App\Http\Controllers\Client\OrderController;
use App\Http\Controllers\Client\BuyerController;
use App\Http\Controllers\Client\ShopController;
use App\Http\Controllers\Sellers\InfoController;
use App\Http\Controllers\Sellers\VoucherController;
use App\Http\Controllers\Sellers\OrderSellerController;
use App\Http\Controllers\Sellers\ProdcutStatisticsController;
use App\Http\Controllers\Sellers\CategoryAndSubcategoryController; 
use App\Http\Controllers\Sellers\Categor;
use App\Http\Controllers\Client\SearchController;
use App\Http\Controllers\Client\PaymentController;
use App\Http\Controllers\Client\WishListController;
use App\Http\Controllers\Auth\GoogleLoginController;
use App\Http\Controllers\FacebookLoginController;





Route::get('/', [HomeController::class, 'index'])->name('client.index');
// test giao diện
Route::get('/san-pham-chi-tiet/{id}', [ProductDetailController::class, 'index'])->name('client.productDetail');


Route::get('/the-loai/{caetegory_slug}/{subcategory_slug?}', [CategoryController::class, 'index']);
Route::post('/the-loai', [CategoryController::class, 'getProductAddress'])->name('category.productAddress');


Route::get('/cua-hang/{id}', [ShopController::class, 'index'])->name('client.shop');
Route::post('/tim-kiem', [SearchController::class, 'index'])->name('client.search');

Route::post('/san-pham/yeu-thich/{id}', [WishListController::class, 'create'])->middleware('auth');
Route::get('/san-pham-yeu-thich', [WishListController::class, 'index'])->name('client.favourite');
Route::get('/san-pham-yeu-thich/xoa/{id}',[WishListController::class,'destroy'])->name('client.wishList.destroy');
Route::post('/theo-doi/cua-hang', [BuyerController::class, 'followSeller'])->name('client.follow.create');
Route::get('/danh-sach/cua-hang', [BuyerController::class, 'index'])->name('client.follow');


Route::prefix('/tai-khoan-cua-toi')->group(function () {
    Route::get('/ho-so', [ProfileController::class, 'index'])->name('account.profile.index');
    Route::put('/ho-so-cap-nhat/{id}', [ProfileController::class, 'update'])->name('account.profile.update');
    Route::get('/dia-chi', [AddressController::class, 'index'])->name('account.address.index');
    Route::post('/dia-chi/them', [AddressController::class, 'create'])->name('account.address.create');
    Route::get('/dia-chi/sua/{id}', [AddressController::class, 'edit'])->name('account.address.edit');
    Route::put('/dia-chi/cap-nhat/{id}', [AddressController::class, 'update'])->name('account.address.update');
    Route::get('/dia-chi/xoa/{id}', [AddressController::class, 'delete'])->name('account.address.delete');
    Route::get('/dia-chi/mac-dinh/{id}', [AddressController::class, 'setDefault'])->name('account.address.setDefault');
    Route::get('/don-mua', [OrderController::class, 'index'])->name('client.order');
    Route::get('/voucher', [HomeController::class, 'voucher']);
});
Route::middleware(['web'])->group(function () {

    Route::get('login/google', [GoogleLoginController::class, 'redirectToGoogle'])->name('login.google');
    Route::get('auth/google/callback', [GoogleLoginController::class, 'handleGoogleCallback']);
    Route::get('/auth/facebook', [FacebookLoginController::class, 'redirectToFacebook'])->name('login.facebook');
    Route::get('/auth/facebook/callback', [FacebookLoginController::class, 'handleFacebookCallback']);
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
    // Password 
    Route::get('/quen-mat-khau',[AccountController::class,'forgotPassword'])->name('account.forgotPassword');
    Route::post('/checkEmail',[AccountController::class,'checkEmail'])->name('account.checkEmail');
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

        Route::get('/thung-rac', [ProductController::class, 'listTrashCan'])->name('seller.product.listTrashCan');

        Route::get('/khoi-phuc/{id}', [ProductController::class, 'restore'])->name('seller.product.restore');

        Route::get('/xoa-mem/{id}', [ProductController::class, 'softDelete'])->name('seller.product.softDelete');

        Route::get('/xoa-san-pham/{id}', [ProductController::class, 'delete'])->name('seller.product.delete');

        Route::get('/cua-hang', [InfoController::class, 'index'])->name('seller.info');

        Route::put('/cua-hang/cap-nhat', [InfoController::class, 'update'])->name('seller.info.update');

        Route::get('/danh-sach/voucher', [VoucherController::class, 'index'])->name('seller.voucher');

        Route::post('/voucher/them',[VoucherController::class,'create'])->name('seller.voucher.create');

        Route::get('/voucher/edit/{id}', [VoucherController::class, 'edit'])->name('seller.voucher.edit');

        Route::get('/voucher/xoa/{id}',[VoucherController::class,'destroy'])->name('seller.voucher.destroy');

        Route::post('/voucher/cap-nhat/{id}',[VoucherController::class,'update'])->name('seller.voucher.update');

        Route::get('/thong-ke/san-pham-ban-chay',[ProdcutStatisticsController::class, 'index'])->name('seller.productStatistics');

        Route::get('/san-pham-ban-chay/chi-tiet/{id}',[ProdcutStatisticsController::class,'detail'])->name('seller.productStatistics.detail');

        Route::get('/danh-muc',[CategoryAndSubcategoryController::class, 'index'])->name('seller.categoryAndSubcategory');

        Route::get('/don-hang',[OrderSellerController::class, 'index'])->name('seller.order');

        Route::get('/don-hang/chi-tiet/{id}/{status?}', [OrderSellerController::class, 'detail'])->name('seller.order.detail');
        
        Route::post('/don-hang/xac-nhan/{id}',[OrderSellerController::class,'confirm'])->name('seller.order.confirm');
       
    });
    // End Seller Route
    // Cart Route
    Route::get('/gio-hang', [CartController::class, 'index'])->name('client.cart');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::post('/cart/submit', [CartController::class, 'submit'])->name('cart.submit');
    Route::get('/thanh-toan', [PaymentController::class, 'index'])->name('checkout');

    // Checkout Processing
    Route::post('/checkout/processing', [PaymentController::class, 'checkoutProcessing'])->name('checkout.processing');

    // VNpay payment
    Route::get('/vnpay_payment',[vnPayController::class,'vnpay_payment'])->name('vnpay_payment');
    Route::get('success',[vnPayController::class,'success'])->name('success');


});
