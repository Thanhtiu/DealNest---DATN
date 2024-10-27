<?php

namespace App\Http\Controllers\Sellers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Seller;
use Illuminate\Support\Facades\Session;


class InfoController extends Controller
{
    public function index()
    {
        $sellerId = Session::get('sellerId');
        $seller = Seller::find($sellerId);
        return view('sellers.info.index', compact('seller'));
    }

    public function update(Request $request)
    {
        $id = $request->seller_id;
        $seller = Seller::find($id);
        if ($request->hasFile('image')) {
            $image = $request->file('image');

            // Kiểm tra và xóa ảnh logo cũ nếu tồn tại
            if ($seller && $seller->image && file_exists(public_path('uploads/' . $seller->logo))) {
                unlink(public_path('uploads/' . $seller->image));
            }

            // Lưu ảnh logo mới
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads'), $imageName);

            // Cập nhật thông tin ảnh logo mới
            $seller->logo = $imageName;
        }

        if ($request->hasFile('background')) {
            $background = $request->file('background');

            // Kiểm tra và xóa hình nền cũ nếu tồn tại
            if ($seller && $seller->background && file_exists(public_path('uploads/' . $seller->background))) {
                unlink(public_path('uploads/' . $seller->background));
            }

            // Lưu hình nền mới
            $backgroundName = time() . '_' . $background->getClientOriginalName();
            $background->move(public_path('uploads'), $backgroundName);

            // Cập nhật thông tin hình nền mới
            $seller->background = $backgroundName;
        }

        // Lưu thông tin seller
        $seller->save();

        $seller->update([
            'name' => $request->name,
            'description' => $request->description,
            'store_phone' => $request->store_phone,
            'store_email' => $request->store_email,
            'logo' => isset($imageName) ? $imageName : $seller->logo,
            'background' => isset($imageName) ? $imageName : $seller->background
        ]);
        return redirect()->back()->with('success', 'Cập nhật hồ sơ cửa hàng thành công!');
    }
}
