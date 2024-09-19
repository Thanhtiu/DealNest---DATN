<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    //
    public function index(Request $request)
    {
        return view('account.login');
    }

    public function authenticate(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255',
            'password' => 'required|min:3',
        ], [
            'password.min' => 'Mật khẩu tối thiểu là 3 kí tự.',
            'email.required' => 'Email là bắt buộc.',
            'email.email' => 'Email không đúng định dạng.',
            'password.required' => 'Mật khẩu là bắt buộc.',
        ]);

        if ($validator->passes()) {

            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

                $check_active = User::where('email', $request->email)->first();
                $user = User::where('email',$request->email)->first();
                $userId = $check_active->id;

                if ($check_active->is_active == 1) {

                    session()->put('userEmail', $request->email);
                    session()->put('userId', $userId);
                    session()->put('userFullName',$user->full_name);
                    


                    return redirect('/');

                } else {

                    session()->put('userEmail', $request->email);

                    session()->flash('alertMessage', 'Tài khoản này chưa được xác thực, vui lòng xác thực tài khoản trước khi đăng nhập! <a href="' . route('otp.sendOTP') . '">Xác thực ngay</a>');
                    session()->flash('alertType', 'error');

                    return redirect()->back();

                }

            } else {
                return redirect()->route('account.login')
                    ->withInput()
                    ->with('login_error', 'Email hoặc mật khẩu không chính xác! Vui lòng thử lại');
            }

        } else {
            return redirect()->route('account.login')
                ->withInput()
                ->withErrors($validator);
        }
    }

    public function register()
    {
        return view('account.register');
    }

    public function processRegister(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255|unique:users',
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required|numeric|digits_between:10,15',
            'password' => 'required|min:3|confirmed',
        ], [
            'password.confirmed' => 'Nhập lại mật khẩu không chính xác',
            'phone.numeric' => "Số điện thoại không đúng định dạng",
            'password.min' => 'Mật khẩu tối thiểu là 3 kí tự.',
            'email.required' => 'Email là bắt buộc.',
            'email.email' => 'Email không đúng định dạng.',
            'password.required' => 'Mật khẩu là bắt buộc.',
        ]);

        if ($validator->passes()) {

            $user = new User();
            $user->name = $request->last_name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->full_name = $request->first_name . $request->last_name;
            $user->password = Hash::make($request->password);
            $user->image = "default_avt.png";
            $user->role = 'buyer';
            if ($user->save()) {

                // Set Session cho việc gửi OTP

                session()->put('userEmail', $user->email);
                session()->put('userId', $user->id);


                session()->flash('alertMessage', 'Đăng ký thành công!');
                session()->flash('alertType', 'success');

                return redirect()->route('otp.sendOTP');


            } else {

                session()->flash('alertMessage', 'Đăng ký thất bại. Vui lòng thử lại!');

                session()->flash('alertType', 'error');

                return redirect()->route('account.login');

            }


        } else {
            return redirect()->route('account.register')
                ->withInput()
                ->withErrors($validator);
        }


    }

    public function logout()
    {

        Auth::logout();

        session()->forget('userEmail');
        session()->forget('userId');
        session()->forget('userFullName');

        return redirect('/');
    }

}