<?php

namespace App\Http\Controllers\Sellers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\Seller;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\Voucher;

class VoucherController extends Controller
{
    public function index()
    {
        $userId = Session::get('userId');
        $seller = Seller::where('user_id', $userId)->first();
        $products = Product::where('seller_id', $seller->id)->with('subcategory')->get();
        $vouchers = Voucher::where('seller_id', $seller->id)->with('subcategory')->get();

        // Lấy ra tất cả các subcategories từ các sản phẩm và loại bỏ subcategory trùng id
        $subcategories = $products->map(function ($product) {
            return $product->subcategory;
        })->filter()->unique('id'); // Loại bỏ các subcategories trùng lặp theo 'id'

        return view('sellers.voucher.index', compact('seller', 'subcategories', 'vouchers'));
    }



    public function create(Request $request)
    {
        // Validate input
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255|unique:vouchers,code',
            'type' => 'required|in:fixed,percentage',
            'end_date' => 'required|date|after_or_equal:today',
            'subcategory_id' => 'required|exists:subcategories,id',
            // Validate giá trị tùy theo loại giảm giá
            'value_amount' => $request->type == 'fixed' ? 'required|numeric|min:0' : 'nullable',
            'value_percent' => $request->type == 'percentage' ? 'required|numeric|min:0|max:100' : 'nullable',
        ], [
            'name.required' => 'Tên voucher là bắt buộc.',
            'code.required' => 'Mã voucher là bắt buộc.',
            'code.unique' => 'Mã voucher đã tồn tại.',
            'type.required' => 'Loại voucher là bắt buộc.',
            'value_amount.required' => 'Giá trị giảm giá bằng tiền là bắt buộc.',
            'value_percent.required' => 'Giá trị giảm giá theo phần trăm là bắt buộc.',
            'value_percent.max' => 'Giá trị phần trăm giảm giá không được vượt quá 100%.',
            'end_date.required' => 'Ngày kết thúc là bắt buộc.',
            'end_date.after_or_equal' => 'Ngày kết thúc phải từ hôm nay trở đi.',
            'subcategory_id.required' => 'Danh mục con là bắt buộc.',
            'subcategory_id.exists' => 'Danh mục con không tồn tại.'
        ]);

        // Tạo voucher mới
        $voucher = new Voucher();
        $voucher->name = $request->name;
        $voucher->code = $request->code;
        $voucher->type = $request->type;

        // Kiểm tra loại giảm giá và gán giá trị cho cột `value`
        if ($request->type == 'fixed') {
            $voucher->value = $request->value_amount;
        } else if ($request->type == 'percentage') {
            $voucher->value = $request->value_percent;
        }

        $voucher->end_date = $request->end_date;
        $voucher->subcategory_id = $request->subcategory_id;
        $voucher->seller_id = $request->seller_id;
        $voucher->start_date = now();

        $voucher->save();

        return redirect()->route('seller.voucher')->with('success', 'Tạo voucher thành công!');
    }


    public function edit($id)
    {
        $voucher = Voucher::find($id);

        if ($voucher) {
            // Chỉ lấy phần ngày mà không có thời gian
            $voucher->end_date = \Carbon\Carbon::parse($voucher->end_date)->format('Y-m-d');
            return response()->json(['voucher' => $voucher]);
        }



        return response()->json(['error' => 'Voucher không tồn tại!'], 404);
    }


    public function update(Request $request, $id)
    {
        // Validate dữ liệu trước khi cập nhật
        $request->validate([
            'edit_name' => 'required|string|max:255',
            'edit_code' => 'required|string|max:255|unique:vouchers,code,' . $id,
            'edit_type' => 'required|in:fixed,percentage',
            'edit_end_date' => 'required|date|after_or_equal:today',
            'edit_subcategory_id' => 'required|exists:subcategories,id',
            // Validate giá trị tùy theo loại giảm giá
            'edit_value_amount' => $request->edit_type == 'fixed' ? 'required|numeric|min:0' : 'nullable',
            'edit_value_percent' => $request->edit_type == 'percentage' ? 'required|numeric|min:0|max:100' : 'nullable',
        ], [
            'edit_name.required' => 'Tên voucher là bắt buộc.',
            'edit_code.required' => 'Mã voucher là bắt buộc.',
            'edit_code.unique' => 'Mã voucher đã tồn tại.',
            'edit_type.required' => 'Loại voucher là bắt buộc.',
            'edit_value_amount.required' => 'Giá trị giảm giá bằng tiền là bắt buộc.',
            'edit_value_percent.required' => 'Giá trị giảm giá theo phần trăm là bắt buộc.',
            'edit_end_date.required' => 'Ngày kết thúc là bắt buộc.',
            'edit_end_date.after_or_equal' => 'Ngày kết thúc phải từ hôm nay trở đi.',
            'edit_subcategory_id.required' => 'Danh mục con là bắt buộc.',
            'edit_subcategory_id.exists' => 'Danh mục con không tồn tại.'
        ]);

        $voucher = Voucher::find($id);

        $voucher->name = $request->edit_name;
        $voucher->code = $request->edit_code;
        $voucher->type = $request->edit_type;

        // Cập nhật giá trị giảm giá dựa trên loại
        if ($request->edit_type == 'fixed') {
            $voucher->value = $request->edit_value_amount;
        } elseif ($request->edit_type == 'percentage') {
            $voucher->value = $request->edit_value_percent;
        }

        $voucher->end_date = $request->edit_end_date;
        $voucher->subcategory_id = $request->edit_subcategory_id;

        $voucher->save();

        return redirect()->route('seller.voucher')->with('success', 'Cập nhật voucher thành công');
    }

    public function destroy($id)
    {
        $voucher = Voucher::find($id);
        if ($voucher) { 
            $voucher->delete();
            return redirect()->back()->with('success', 'Xóa voucher thành công!');
        }
    }
}
