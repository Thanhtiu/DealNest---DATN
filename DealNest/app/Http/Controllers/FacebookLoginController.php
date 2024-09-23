<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FacebookLoginController extends Controller
{
    // Phương thức chuyển hướng người dùng đến Facebook để đăng nhập
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    // Phương thức xử lý callback từ Facebook
    public function handleFacebookCallback()
    {
        try {
            $facebookUser = Socialite::driver('facebook')->stateless()->user();

            // Kiểm tra nếu người dùng đã tồn tại
            $existingUser = User::where('facebook_id', $facebookUser->id)->first();

            if ($existingUser) {
                // Đăng nhập nếu người dùng đã tồn tại
                Auth::login($existingUser);
            } else {
                // Nếu chưa tồn tại, tạo mới người dùng
                $newUser = User::create([
                    'name' => $facebookUser->name,
                    'email' => $facebookUser->email,
                    'facebook_id' => $facebookUser->id,
                    // Bạn có thể lưu thêm thông tin khác như avatar
                ]);

                // Đăng nhập người dùng mới
                Auth::login($newUser);
            }

            // Chuyển hướng về trang chính sau khi đăng nhập thành công
            return redirect('/home');

        } catch (\Exception $e) {
            // Xử lý lỗi nếu có vấn đề với đăng nhập
            return redirect('/login')->with('error', 'Đăng nhập Facebook thất bại, vui lòng thử lại.');
        }
    }
}
