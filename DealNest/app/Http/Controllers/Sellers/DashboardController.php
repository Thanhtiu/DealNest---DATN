<?php

namespace App\Http\Controllers\Sellers;

use App\Http\Controllers\Controller;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function index(){
        
        if(Session::has('userEmail')){
            
            $userEmail = Session::get('userEmail');

            $user = Seller::where('store_email',$userEmail)->first();

            if(is_null($user)){
                return redirect()->route('seller.register.index');
            }
        }

        return view('sellers.index');
    }
}