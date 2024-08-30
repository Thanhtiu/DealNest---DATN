<?php

namespace App\Http\Controllers\Sellers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        return view('sellers.index');
    }

    public function store(){
        return view('sellers.products.manage');
    }
}
