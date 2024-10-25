<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\Cart;
use App\Models\Cart_item;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Log;





class CartController extends Controller
{
    public function index()
    {
        $userId = Session::get('userId');

        // Lấy giỏ hàng của người dùng
        $cart = Cart::where('user_id', $userId)->first();

        if (!$cart) {
            return view('client.cart', ['carts' => []]); // Nếu không có giỏ hàng, trả về giỏ hàng rỗng
        }

        // Lấy danh sách các mục trong giỏ hàng
        $cartItems = $cart->items()->with('product')->get();
        // Tính tổng giá của giỏ hàng
        $totalPrice = $cartItems->sum('total_price');

        return view('client.cart', compact('cart', 'cartItems', 'totalPrice'));
    }



    public function add(Request $request)
    {
        // Lấy user_id từ session
        $userId = Session::get('userId');

        // Tìm giỏ hàng của người dùng
        $cart = Cart::where('user_id', $userId)->first();

        // Nếu chưa có giỏ hàng, tạo mới
        if (!$cart) {
            $cart = Cart::create([
                'user_id' => $userId,
                'total_price' => 0,
                'quantity' => 0,
            ]);
        }

        // Tìm sản phẩm
        $product = Product::findOrFail($request->product_id);

        // Tính tổng giá mới
        $totalPrice = $product->price * $request->quantity;

        // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
        $cartItem = Cart_item::where('cart_id', $cart->id)
            ->where('product_id', $product->id)
            ->where('color', $request->color)
            ->where('size', $request->size)
            ->first();

        if ($cartItem) {
            // Nếu có, cập nhật số lượng và tổng giá
            $cartItem->quantity += $request->quantity;
            $cartItem->total_price += $totalPrice;
            $cartItem->save();
        } else {
            // Nếu chưa có, thêm mới mục vào giỏ hàng
            Cart_item::create([
                'cart_id' => $cart->id,
                'product_id' => $product->id,
                'color' => $request->color,
                'size' => $request->size,
                'quantity' => $request->quantity,
                'total_price' => $totalPrice,
            ]);
        }

        // Cập nhật tổng giá của giỏ hàng
        $cart->total_price += $totalPrice;

        // Cập nhật quantity của giỏ hàng dựa trên số lượng bản ghi cart_items thuộc cart_id
        $cart->quantity = Cart_item::where('cart_id', $cart->id)->count(); // Đếm số lượng bản ghi

        // Lưu giỏ hàng
        $cart->save();

        return back()->with('success', 'Sản phẩm đã được thêm vào giỏ hàng');
    }






    private function calculatePrice($productId, $quantity)
    {
        // Tính toán giá sản phẩm
        $product = Product::find($productId);
        return $product->price * $quantity;
    }




    public function destroy(Request $request)
    {
        // Lấy danh sách các sản phẩm đã được chọn
        $selectedItems = $request->input('checkbox', []);

        // Nếu không có sản phẩm nào được chọn, trả về thông báo lỗi
        if (empty($selectedItems)) {
            return response()->json(['success' => false, 'message' => 'Không có sản phẩm nào được chọn.']);
        }

        // Xóa các sản phẩm đã chọn khỏi giỏ hàng
        foreach ($selectedItems as $itemId) {
            // Tìm sản phẩm trong giỏ hàng và xóa nó
            Cart::find($itemId)->delete();
        }

        return response()->json(['success' => true, 'message' => 'Xóa thành công!']);
    }


    public function submit(Request $request)
    {
        // Lấy danh sách các ID sản phẩm từ checkbox
        $selectedIds = $request->input('checkbox', []);

        // Khởi tạo tổng số tiền
        $totalAmount = 0;

        // Mảng chứa thông tin các sản phẩm đã chọn
        $selectedItems = [];

        // Tính tổng giá trị total_price cho các sản phẩm được chọn và lưu thông tin vào mảng
        foreach ($selectedIds as $id) {
            $item = Cart::find($id); // Giả sử bạn có một model CartItem
            if ($item) {
                $totalAmount += $item->total_price; // Cộng dồn total_price

                // Lấy thông tin các thuộc tính của sản phẩm
                $attributes = $item->items->map(function ($cartItem) {
                    return [
                        'name' => $cartItem->attribute->name, // Tên thuộc tính
                        'value' => $cartItem->value, // Giá trị thuộc tính
                    ];
                });

                // Lưu thông tin sản phẩm vào mảng, bao gồm cả thuộc tính
                $selectedItems[] = [
                    'product_id' => $item->product_id,
                    'product_name' => $item->product->name,
                    'quantity' => $item->quantity,
                    'total_price' => $item->total_price,
                    'attributes' => $attributes->toArray(), // Lưu các thuộc tính vào mảng
                ];
            }
        }

        // Kiểm tra nếu không có sản phẩm nào được chọn
        if (empty($selectedIds)) {
            return response()->json(['success' => false]);
        }

        // Lưu tổng số tiền và thông tin sản phẩm vào session
        session(['total_amount' => $totalAmount]);
        session(['selected_items' => $selectedItems]);

        // Trả về tổng số tiền và thông tin sản phẩm đã chọn
        return response()->json(['success' => true, 'total_amount' => $totalAmount, 'selected_items' => $selectedItems]);
    }
}
