<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

use App\Models\Product;
use Carbon\Carbon;
use App\Models\Address;
use App\Models\Wishlist;

class ProductDetailController extends Controller
{
    public function index($id, $slug)
    {
        $productDetail = Product::with(['category.parent', 'product_image', 'productVariants'])->find($id);
        $product = Product::with('seller')->find($id);
        $seller = $product->seller;

        $countProduct = Product::where('seller_id', $seller->id)->count();

        // Calculate days since the seller joined
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

        // Check if the product is favorited by the user
        $isFavourited = Wishlist::where('user_id', auth()->id())
            ->where('product_id', $id)
            ->exists();

        // Fetch related products from the same category, excluding the current product
        $relatedProducts = Product::with('product_image')
            ->where('category_id', $productDetail->category_id)
            ->where('id', '!=', $id)
            ->take(4) 
            ->get();

        return view('client.product-detail', compact(
            'productDetail',
            'seller',
            'countProduct',
            'dateJoin',
            'string_address',
            'isFavourited',
            'relatedProducts'
        ));
    }
}
