<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Wishlist;
use App\Models\User;
use PhpParser\Node\Expr\FuncCall;

class WishListController extends Controller
{
    public function index()
    {
        $userId = auth()->user()->id;
        $WishLists = Wishlist::with('product.subcategory.category')->where('user_id', $userId)->get();
        // return $WishLists;
        return view('client.wishlist', compact('WishLists'));
    }

    public function create(Request $request, $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        $userId = auth()->id();

        // Kiểm tra nếu sản phẩm đã được yêu thích
        $wishlist = Wishlist::where('user_id', $userId)->where('product_id', $id)->first();

        if (!$wishlist) {
            // Nếu chưa yêu thích, thêm vào danh sách yêu thích 
            Wishlist::create([
                'user_id' => $userId,
                'product_id' => $id,
            ]);
            $product->favourite = $product->favourite + 1;
            $product->save();
            return response()->json([
                'success' => true,
                'status' => 'added',
                'favourite' => $product->favourite, // Trả về số lượt thích mới
                'message' => 'Sản phẩm đã được thêm vào danh sách yêu thích!'
            ]);
        } else {
            // Nếu đã yêu thích, xóa sản phẩm khỏi danh sách yêu thích
            $wishlist->delete();
            $product->favourite = $product->favourite - 1;
            $product->save();
            return response()->json([
                'success' => true,
                'status' => 'removed',
                'favourite' => $product->favourite,
                'message' => 'Sản phẩm đã được xóa khỏi danh sách yêu thích!'
            ]);
        }
    }

    public function destroy($id)
    {
        $wishList = Wishlist::find($id);
        $wishList->delete();
        return redirect()->back()->with('success', 'Xóa thành công!');
    }
}
