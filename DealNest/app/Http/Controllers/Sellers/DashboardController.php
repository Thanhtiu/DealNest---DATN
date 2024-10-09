<?php

namespace App\Http\Controllers\Sellers;

use App\Http\Controllers\Controller;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
class DashboardController extends Controller
{
    public function index()
    {
        $userId = Session::get('userId'); 
        $seller = Seller::where('user_id', $userId)->first(); 

        if (!$seller) {
            return redirect()->route('seller.register.index');
        } else {
            if($seller->status == 0){
                session()->flash('alertMessage', "Cửa hàng của bạn đang tạm khóa vì lý do ".$seller->note.". Liên hệ dịch vụ chăm sóc khách hàng để được giải quyết!");
                session()->flash('alertType', 'error');
                return redirect('/');
            }
            $sellerId = $seller->id;
            Session::put('sellerId', $sellerId);
            return view('sellers.index'); 
        }


// class DashboardController extends Controller
// {
//     public function index(){
        
//         if(Session::has('userEmail')){
            
//             $userEmail = Session::get('userEmail');

//             $user = Seller::where('store_email',$userEmail)->first();

//             if(is_null($user)){
//                 return redirect()->route('seller.register.index');
//             }
//         }


//     }
    
}
}