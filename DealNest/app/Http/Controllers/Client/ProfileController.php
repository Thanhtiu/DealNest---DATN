<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{
    public function index()
    {
        $user = User::where('id', auth()->id())->first();
        return view('client.profile', compact('user'));
    }
    public function update(Request $request, $id)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'name' => 'required|string|max:255', // Tên không được để trống và tối đa 255 ký tự
            'phone' => 'required|digits_between:10,11|unique:users,phone,' . $id, // Số điện thoại từ 10-11 số và không được trùng
            'email' => 'required|email|unique:users,email,' . $id, // Email hợp lệ và không được trùng
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Hình ảnh (nếu có) và giới hạn kích thước
        ], [
            'name.required' => 'Tên không được để trống.',
            'name.string' => 'Tên phải là một chuỗi.',
            'name.max' => 'Tên không được vượt quá 255 ký tự.',
            'phone.required' => 'Số điện thoại là bắt buộc.',
            'phone.digits_between' => 'Số điện thoại phải có từ 10 đến 11 chữ số.',
            'phone.unique' => 'Số điện thoại đã tồn tại.',
            'email.required' => 'Email là bắt buộc.',
            'email.email' => 'Email không hợp lệ.',
            'email.unique' => 'Email đã tồn tại.',
            'image.image' => 'Hình ảnh không hợp lệ.',
            'image.mimes' => 'Hình ảnh phải có định dạng: jpg, jpeg, png.',
            'image.max' => 'Kích thước hình ảnh không được vượt quá 2048 kilobyte.',
        ]);


        $user = User::find($id);

        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->email = $request->email;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);
            $user->image = $filename;
        }

        $user->save();

        return redirect()->back()->with('success', 'Cập nhật thành công');
    }
}
