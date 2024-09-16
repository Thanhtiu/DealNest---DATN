<?php

namespace App\Http\Controllers\Sellers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Seller;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\Address;
use Google\Cloud\Vision\V1\ImageAnnotatorClient;

class RegisterTrationController extends Controller
{
    public function index(Request $request)
    {

        if (Session::has('userEmail')) {

            $userEmail = Session::get('userEmail');

            $user = Seller::where('store_email', $userEmail)->first();

            if (!is_null($user)) {

                return redirect()->route('seller.index');
            }

        }

        return view('sellers.register.index');
    }

    public function form()
    {
        if (Session::has('userEmail')) {

            $userEmail = Session::get('userEmail');

            $checkSellerAlready = Seller::where('store_email', $userEmail)->first();

            if (!is_null($checkSellerAlready)) {

                return redirect()->route('seller.index');
            }

            $user = User::where('email', $userEmail)->first();

            if (!is_null($user)) {

                return view('sellers.register.form', compact('user'));
            }

        } else {
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
            'store_phone' => 'required|numeric|digits_between:10,11',
            'store_email' => 'required|string|email|unique:sellers',
            'string_address' => 'required|string',
            'street' => 'required|string',
            'cccd' => 'required|numeric|digits:12',

        ], [
            'store_name.required' => 'Tên Shop là bắt buộc.',
            'store_name.max' => 'Tên Shop không được dài quá 255 ký tự.',
            'province.required' => 'Vui lòng chọn tỉnh/thành phố.',
            'district.required' => 'Vui lòng chọn huyện/quận.',
            'ward.required' => 'Vui lòng chọn xã/phường.',
            'store_phone.required' => 'Số điện thoại là bắt buộc.',
            'store_phone.numeric' => 'Số điện thoại phải là số.',
            'store_phone.digits_between' => 'Số điện thoại phải có từ 10 đến 11 chữ số.',
            'store_email.required' => 'Email là bắt buộc.',
            'store_email.email' => 'Email phải hợp lệ.',
            // 'store_email.unique' => 'Email đã tồn tại, vui lòng chọn email khác.',
            'string_address.required' => 'Địa chỉ hiện tại là bắt buộc.',
            'street.required' => 'Đường cụ thể là bắt buộc.',
            'cccd.required' => 'Số căn cước công dân là bắt buộc.',
            'cccd.numeric' => 'Số căn cước công dân phải là số.',
            'cccd.digits' => 'Số căn cước công dân phải có đúng 12 chữ số.'
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

        $user->role = 'seller';
        $user->save();

        return redirect()->route('seller.index')->with('success', 'Đăng ký người bán thành công');
    }


}