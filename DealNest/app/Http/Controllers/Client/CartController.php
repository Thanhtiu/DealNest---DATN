<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\Cart;
use App\Models\Cart_item;
use App\Models\User;
use App\Models\Product;
use App\Models\attribute_value;
use Illuminate\Support\Facades\Log;





class CartController extends Controller
{
    public function index()
    {
        $userId = Session::get('userId');
        $carts = Cart::where('user_id', $userId)
            ->with('product.product_image', 'items.attribute')
            ->get();
        // return dd($carts);
        return view('client.cart', compact('carts'));
    }


    public function add(Request $request)
    {
        $userId = Session::get('userId');

        // Validation cho form
        $validatedData = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'attributes' => 'required|array',
            'attributes.*' => 'required|string', // Validation cho từng thuộc tính
        ]);

        $totalPrice = 0;
        $discountValue = 0; // Biến để lưu giá trị discount (tính từ thuộc tính hoặc giá sản phẩm)
        $hasCustomPrice = false; // Biến để kiểm tra nếu có giá riêng

        // Lặp qua các thuộc tính và kiểm tra giá riêng
        foreach ($validatedData['attributes'] as $attributeId => $attributeValue) {
            // Lấy thông tin attribute_value từ DB
            $attributeValueRecord = attribute_value::where('attribute_id', $attributeId)
                ->where('product_id', $validatedData['product_id'])
                ->where('value', $attributeValue)
                ->first();

            if ($attributeValueRecord && $attributeValueRecord->price) {
                // Nếu có giá riêng cho thuộc tính, gán giá này cho discount
                $discountValue = $attributeValueRecord->price; // Gán giá trị discount là giá của thuộc tính
                $hasCustomPrice = true; // Đánh dấu có giá riêng
                break; // Không cần tiếp tục kiểm tra các thuộc tính khác
            }
        }

        if (!$hasCustomPrice) {
            // Nếu không có giá riêng, lấy giá từ bảng products
            $product = Product::find($validatedData['product_id']);
            $discountValue = $product->price; // Nếu không có giá riêng, discount là giá sản phẩm
        }

        // Tính tổng giá dựa trên số lượng và discount (nếu có)
        $totalPrice = $discountValue * $validatedData['quantity'];

        // Tạo bản ghi mới trong bảng carts
        $cart = Cart::create([
            'user_id' => $userId,
            'product_id' => $validatedData['product_id'],
            'total_price' => $totalPrice,
            'quantity' => $validatedData['quantity'],
            'discount' => $discountValue, // Lưu giá trị discount (giá của thuộc tính hoặc sản phẩm) vào bảng carts
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
