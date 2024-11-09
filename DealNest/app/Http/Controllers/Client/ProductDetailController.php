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
use App\Models\Review;
use App\Models\Review_image;

use function Livewire\revert;

class ProductDetailController extends Controller
{
    public function index($id, $slug)
    {
        $productDetail = Product::with(['category.parent', 'product_image', 'productVariants'])->find($id);
        $product = Product::with('seller')->find($id);
        $seller = $product->seller;

        $countProduct = Product::where('seller_id', $seller->id)->count();

        $totalSales = Product::where('seller_id', $seller->id)->sum('sales');

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

        $isFavourited = Wishlist::where('user_id', auth()->id())
            ->where('product_id', $id)
            ->exists();

        $relatedProducts = Product::with('product_image')
            ->where('category_id', $productDetail->category_id)
            ->where('id', '!=', $id)
            ->take(4)
            ->get();

        $reviews = Review::where('product_id', $productDetail->id)
            ->with(['user', 'images'])
            ->get();

        $startCounts = Review::where('product_id', $productDetail->id)
            ->select('rating', DB::raw('count(*) as count'))
            ->groupBy('rating')
            ->pluck('count', 'rating');

        $stars = [
            1 => 0,
            2 => 0,
            3 => 0,
            4 => 0,
            5 => 0,
        ];

        foreach ($startCounts as $rating => $count) {
            $stars[$rating] = $count;
        }

        $reviewCounts = Review::where('product_id', $productDetail->id)->count();

        $averageRating = Review::where('product_id', $productDetail->id)->avg('rating');

        return view('client.product-detail', compact(
            'productDetail',
            'seller',
            'countProduct',
            'dateJoin',
            'string_address',
            'isFavourited',
            'relatedProducts',
            'reviews',
            'totalSales',
            'startCounts',
            'stars',
            'reviewCounts',
            'averageRating'
        ));
    }
}
