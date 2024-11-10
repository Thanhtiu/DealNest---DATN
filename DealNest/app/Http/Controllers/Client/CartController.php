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
        // Tìm sản phẩm
        $product = Product::findOrFail($request->product_id);

        // Xác định giá mặc định từ sản phẩm
        $defaultPrice = $product->price;

        // Xác định giá và giá trị mặc định cho color và size
        $colorPrice = $defaultPrice; // Sử dụng giá mặc định ban đầu
        $selectedColor = 'Mặc định'; // Giá trị mặc định nếu không có màu
        $selectedSize = 'Mặc định'; // Giá trị mặc định nếu không có kích thước

        // Kiểm tra xem có thuộc tính "color" được gửi từ request không
        if ($request->has('color') && $request->color != 'null') {
            $colorInfo = explode('|', $request->color);

            if (count($colorInfo) < 2) {
                return back()->withErrors(['color' => 'Giá trị màu sắc không hợp lệ.']);
            }

            $colorPrice = (float) $colorInfo[0];
            $selectedColor = trim($colorInfo[1]);
        }

        // Kiểm tra xem có thuộc tính "size" được gửi từ request không
        if ($request->has('size') && $request->size != 'null') {
            $selectedSize = $request->size;
        }

        // Tính tổng giá mới
        $totalPrice = $colorPrice * $request->quantity;

        // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
        $cartItem = Cart_item::where('cart_id', $cart->id)
            ->where('product_id', $product->id)
            ->where('color', $selectedColor)
            ->where('size', $selectedSize)
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
                'color' => $selectedColor,
                'size' => $selectedSize,
                'quantity' => $request->quantity,
                'price' => $colorPrice,
                'total_price' => $totalPrice,
            ]);
        }

        // Cập nhật tổng giá của giỏ hàng
        $cart->total_price += $totalPrice;

        // Cập nhật quantity của giỏ hàng dựa trên số lượng bản ghi cart_items thuộc cart_id
        $cart->quantity = Cart_item::where('cart_id', $cart->id)->count();

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
        try {
            $ids = $request->input('ids');

            // Kiểm tra nếu có ids
            if (!empty($ids)) {
                // Sử dụng mô hình CartItem để xóa
                Cart_item::whereIn('id', $ids)->delete();
                return response()->json(['success' => true]);
            } else {
                return response()->json(['success' => false, 'message' => 'Không có sản phẩm nào để xóa.']);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Lỗi khi xóa sản phẩm: ' . $e->getMessage()]);
        }
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
