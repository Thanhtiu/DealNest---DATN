<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\Cart;
use App\Models\Cart_item;

use App\Models\User;
use App\Models\Product_image;
use App\Models\Product;
use App\Models\Product_attribute;
use Illuminate\Support\Facades\Log;




class CartController extends Controller
{
    public function index()
    {
        $userId = auth()->id(); // Hoặc Session::get('userId') nếu bạn lưu ID người dùng trong session
        $carts = Cart::where('user_id', $userId)
            ->with('product.product_image', 'items.attribute')
            ->get();
        // return dd($carts);
        return view('client.cart', compact('carts'));
    }


    public function add(Request $request)
{
    // Validation cho form
    $validatedData = $request->validate([
        'product_id' => 'required|exists:products,id',
        'quantity' => 'required|integer|min:1',
        'attributes' => 'required|array',
        'attributes.*' => 'required|string', // Validation cho từng thuộc tính
    ]);

    // Tạo bản ghi mới trong bảng carts
    $cart = Cart::create([
        'user_id' => auth()->id(),
        'product_id' => $validatedData['product_id'],
        'total_price' => $this->calculatePrice($validatedData['product_id'], $validatedData['quantity']),
        'quantity' => $validatedData['quantity'],
    ]);

    // Lặp qua các thuộc tính để thêm vào bảng cart_items
    foreach ($validatedData['attributes'] as $attributeId => $attributeValue) {
        Cart_item::create([
            'cart_id' => $cart->id,
            'attribute_id' => $attributeId,
            'value' => $attributeValue,
        ]);
    }

    // Trả về trang trước với thông báo thành công
    return back()->with('success', 'Sản phẩm đã được thêm vào giỏ hàng');
}


    
    
    

    private function calculatePrice($productId, $quantity)
    {
        // Tính toán giá sản phẩm
        $product = Product::find($productId);
        return $product->price * $quantity;
    }
    







    public function destroy($id)
    {
        $cart = Cart::find($id);

        if ($cart) {
            $cart->delete();
            return response()->json([
                'success' => true,
                'message' => 'Sản phẩm đã được xóa khỏi giỏ hàng!'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Sản phẩm không tìm thấy!'
        ], 404);
    }
}
