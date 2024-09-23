<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Brand;
use App\Models\Product_image;
use App\Models\Attribute;
use App\Models\Seller;
use Carbon\Carbon;
use App\Models\Address;

class ProductDetailController extends Controller
{
    public function index($id)
    {
        $productDetail = Product::with(['subcategory', 'product_image', 'product_attribute'])->find($id);
        $product = Product::with('seller')->find($id);

        $seller = $product->seller;
        $countProduct = Product::where('seller_id', $seller->id)->count();
        $currentDate = Carbon::now();
        // Tạo đối tượng Carbon từ ngày trong CSDL
        $startDate = Carbon::parse($seller->created_at);
        // Tính số ngày giữa 2 ngày
        $dateJoin = round($startDate->diffInDays($currentDate));

        $string_address =  'Vui lòng cập nhật địa chỉ';
        $userId = Session::get('userId');
        if ($userId) {
            $addressId = Address::where('user_id', $userId)
                ->where('active', 1)
                ->first();
            $string_address = $addressId->string_address;
        }


        return view('client.product-detail', compact(
            'productDetail',
            'seller',
            'countProduct',
            'dateJoin',
            'string_address'
        ));
    }
}
