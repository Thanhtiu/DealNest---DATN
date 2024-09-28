<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Brand;
use App\Models\Product_image;
use App\Models\Attribute;
use App\Models\Seller;
use Carbon\Carbon;
use App\Models\Address;
use App\Models\Wishlist;

class ProductDetailController extends Controller
{
    public function index($id)
    {

        $productDetail = Product::with(['subcategory', 'product_image', 'attribute_values.attribute'])->find($id);


        $product = Product::with('seller')->find($id);
        $seller = $product->seller;


        $countProduct = Product::where('seller_id', $seller->id)->count();

        // Tính số ngày seller đã tham gia
        $currentDate = Carbon::now();
        $startDate = Carbon::parse($seller->created_at);
        $dateJoin = round($startDate->diffInDays($currentDate));


        $string_address = 'Vui lòng cập nhật địa chỉ';
        $userId = Session::get('userId');
        if ($userId) {
            $address = Address::where('user_id', $userId)
                ->where('active', 1)
                ->first();
            if ($address) {
                $string_address = $address->string_address;
            }
        }

        // Kiểm tra nếu sản phẩm đã được yêu thích bằng Eloquent Model
        $isFavourited = Wishlist::where('user_id', auth()->id())
            ->where('product_id', $id)
            ->exists();

        return view('client.product-detail', compact(
            'productDetail',
            'seller',
            'countProduct',
            'dateJoin',
            'string_address',
            'isFavourited'
        ));
    }


   

    
}
