<?php

namespace App\Http\Controllers\Sellers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Seller;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\Address;

class RegisterTrationController extends Controller
{
    public function index(Request $request)
    {

        if(Session::has('userEmail')){

            $userEmail = Session::get('userEmail');

            $user = Seller::where('store_email',$userEmail)->first();

            if(!is_null($user)){

               return redirect()->route('seller.index');
            }
            
        }

        return view('sellers.register.index');
    }

    public function form()
    {
        if(Session::has('userEmail')){

            $userEmail = Session::get('userEmail');

            $checkSellerAlready = Seller::where('store_email',$userEmail)->first();

            if(!is_null($checkSellerAlready)){

                return redirect()->route('seller.index');
            }

            $user = User::where('email',$userEmail)->first();

            if(!is_null($user)){

                return view('sellers.register.form', compact('user'));
            }

        }else{
            return redirect()->route('account.login');
        }   
              
    }

    public function store(Request $request)
{
    $userEmail = Session::get('userEmail');

    // Get user by email
    $user = User::where('email', $userEmail)->first();
    $userId = $user->id;

    // Validate request inputs
    $request->validate([
        'store_name' => 'required|string|max:255',
        'province' => 'required|string',
        'district' => 'required|string',
        'ward' => 'required|string',
        'store_phone' => 'required|string',
        'store_email' => 'required|string|unique:sellers',
        'string_address' => 'required|string',
        'street' => 'required|string',
    ]);

    // Create address record
    $address = Address::create([
        'user_id' => $userId,
        'province_id' => $request->input('province'),
        'district_id' => $request->input('district'),
        'ward_id' => $request->input('ward'),
        'street' => $request->input('street'),
        'string_address' => $request->input('string_address'),
    ]);

    // Create seller record
    $seller = Seller::create([
        'user_id' => $userId,
        'store_name' => $request->input('store_name'),
        'store_phone' => $request->input('store_phone'),
        'store_email' => $request->input('store_email'),
        'address_id' => $address->id,
    ]);



    return redirect()->route('seller.index')->with('success', 'Đăng ký người bán thành công');
}

}