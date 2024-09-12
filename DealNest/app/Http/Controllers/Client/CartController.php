<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\Cart;
use App\Models\User;
use App\Models\Product_image;
use App\Models\Product;



class CartController extends Controller
{
    public function index()
    {
        $userId = Session::get('userId');
        $carts = Cart::where('user_id', $userId)
            ->with('product.product_image') // Nạp sản phẩm và hình ảnh của sản phẩm
            ->get();

        return view('client.cart', compact('carts'));
    }

    public function destroy($id)
    {
        $cart = Cart::find($id);
        if ($cart) {
            $cart->delete();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false], 404);

    }
}
