<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return view('index');
    }
    public function profile(){
        return view('client.profile');
    }
    public function adress(){
        return view('client.adress');
    }
    public function voucher(){
        return view('client.voucher');
    }
    public function productDetail(){
        return view('client.product-detail');
    }
}
