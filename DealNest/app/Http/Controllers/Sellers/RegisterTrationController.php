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
    public function index()
    {
        if (!Session::has('seller_register_name')) {
            Session::put('seller_register_name', 'User123');
            Session::put('seller_register_id', '2');
        }
        return view('sellers.register.index');
    }

    public function form()
    {
        $id = Session::get('seller_register_id');
        $user = User::find($id);
        return view('sellers.register.form', compact('user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'store_name' => 'required|string|max:255',
            'province' => 'required|string',
            'district' => 'required|string',
            'ward' => 'required|string',
            'store_phone' => 'required|string',
            'store_email' => 'required|string',
            'string_address' => 'required|string',
            'street' => 'required|string',
        ]);

        // Create address
        $address = Address::create([
            'user_id' => Session::get('seller_register_id'),
            'province_id' => $request->input('province'),
            'district_id' => $request->input('district'),
            'ward_id' => $request->input('ward'),
            'street' => $request->input('street'),
            'string_address' => $request->input('string_address'),
        ]);

        // Create seller
        Seller::create([
            'user_id' => Session::get('seller_register_id'),
            'store_name' => $request->input('store_name'),
            'store_phone' => $request->input('store_phone'),
            'store_email' => $request->input('store_email'),
            'address_id' => $address->id,
        ]);

        return redirect()->route('seller.index')->with('success', 'Đăng ký người bán thành công');
    }
}
