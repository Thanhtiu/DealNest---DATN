<?php

namespace App\Http\Controllers\Sellers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Product;
use App\Models\Voucher;



class VoucherController extends Controller
{
    public function index()
    {
        $sellerId = Session::get('sellerId');
        $products = Product::where('seller_id', $sellerId)->get();
        $vouchers = Voucher::where('seller_id', $sellerId)->get();
        return view('sellers.voucher.index', compact('products', 'vouchers'));
    }

    public function create(Request $request)
    {

        $voucher = new Voucher();
        $voucher->product_id = $request->input('product_id');
        $voucher->seller_id = Session::get('sellerId');
        $voucher->name = $request->input('name');
        $voucher->code = $request->input('code');
        $voucher->type = $request->input('type');

        // Gán giá trị dựa trên loại giảm giá
        if ($request->input('type') === 'fixed') {
            $voucher->value = $request->input('vndValue'); 
        } else {
            $voucher->value = $request->input('percentValue'); 
        }

        $voucher->start_date = $request->input('start_date');
        $voucher->end_date = $request->input('end_date');
        $voucher->status = $request->input('status');
        $voucher->save();

        return redirect()->route('seller.voucher')->with('success', 'Voucher được thêm thành công!');
    }


    public function edit($id)
    {
        $voucher = Voucher::find($id);

        if (!$voucher) {
            return response()->json(['error' => 'Voucher not found'], 404);
        }

        $products = Product::all();

        return response()->json([
            'voucher' => $voucher,
            'products' => $products
        ]);
    }

    public function update(Request $request, $id)
    {
        $voucher = Voucher::findOrFail($id);

        $voucher = Voucher::findOrFail($id);
        $voucher->product_id = $request->input('product_id');
        $voucher->name = $request->input('name');
        $voucher->code = $request->input('code');
        $voucher->type = $request->input('type');
        $voucher->value = $request->input('value');
        $voucher->start_date = $request->input('start_date');
        $voucher->end_date = $request->input('end_date');
        $voucher->status = $request->input('status');
        $voucher->save();

        return redirect()->route('seller.voucher')->with('success', 'Voucher cập nhật thành công!');
    }

    public function destroy($id)
    {
        $voucher = Voucher::find($id);

        if (!$voucher) {
            return redirect()->route('seller.voucher')->withErrors(['Voucher not found']);
        }
        $voucher->delete();

        return redirect()->route('seller.voucher')->with('success', 'Voucher xóa thành công!');
    }
}
