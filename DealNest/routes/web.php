<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});


Route::get('/kenh-nguoi-ban', function(){
    return view('sellers.index');
});