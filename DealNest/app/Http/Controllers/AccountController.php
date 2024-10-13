<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Address;

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
                $user = User::where('email', $request->email)->first();
                $userId = $check_active->id;

                if ($check_active->is_active == 1) {

                    session()->put('userEmail', $request->email);
                    session()->put('userId', $userId);
                    session()->put('userFullName', $user->full_name);
                    $address = Address::where('user_id', $userId)
                        ->where('active', 1)
                        ->first();
                    if ($address) {
                        $string_address = $address->string_address;
                        session()->put('stringAddress', $string_address);
                    }
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
        session()->invalidate();
        return redirect('/');
    }


    public function forgotPassword(Request $request){

        return view('account.forgotPassword');

    }


    public function checkEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255',
        ], [
            'email.email' => 'Email không đúng định dạng.',
            'email.required' => 'Email không được bỏ trống.',
        ]);

        if ($validator->passes()) {

            $emailExists = User::where('email', $request->email)->exists();

            if ($emailExists) {

                session()->put('userEmail', $request->email);
                
                session()->put('forgotPassword', true);

                return redirect()->route('otp.sendOTP');

            } else {

                return redirect()->route('account.forgotPassword')
                    ->withInput()
                    ->with('email_error', 'Email không tồn tại trong hệ thống.');
            }
        } else {
    
            return redirect()->route('account.forgotPassword')
                ->withInput()
                ->withErrors($validator);
        }
    }

    public function newPassword(){

        return view('account.newPassword');

    }

    public function newPasswordProcessing(Request $request){

        $validator = Validator::make($request->all(), [
            'password' => 'required|min:3|confirmed',
        ], [
            'password.confirmed' => 'Nhập lại mật khẩu không chính xác',
            'password.required' => 'Mật khẩu là bắt buộc.',
        ]);

        if($validator->passes()){

                $userEmail = session('userEmail');

                $user = User::where('email', $userEmail)->first();
        
                if ($user) {
        
                    $user->password = Hash::make($request->password);
                    
                    $user->save();
        
                    session()->forget('userEmail');
                    
                    session()->flash('alertMessage', 'Thay đổi mật khẩu thành công!');
                    session()->flash('alertType', 'success');
        
                    return redirect()->route('account.login');
        
                } else {
                    return redirect()->route('account.newPassword')
                        ->with('password_error', 'Không tìm thấy người dùng.');
                }

        }else{

            return redirect()->route('account.newPassword')
            ->withInput()
            ->withErrors($validator); 
        }
        

    }

    public function changePassword(){
        return view('account.changePassword');
    }

    public function changePasswordProcessing(Request $request){
        

        $validator = Validator::make($request->all(), [
            'password' => 'required|min:3|confirmed',
            'old_password' => 'required|min:3',
        ], [
            'password.min' => 'Mật khẩu tối thiểu là 3 kí tự.',
            'password.confirmed' => 'Nhập lại mật khẩu không chính xác',
            'password.required' => 'Mật khẩu là bắt buộc.',
            'old_password.required' => 'Mật khẩu cũ là bắt buộc.',
        ]);


        if($validator->passes()){

            $user = Auth::user(); 

            if (Hash::check($request->old_password, $user->password)) {
                $user->password = Hash::make($request->password); 
                $user->save(); 

                Auth::logout();
                session()->invalidate();
    
                session()->flash('alertMessage', 'Thay đổi mật khẩu thành công! Vui lòng đăng nhập lại');
                session()->flash('alertType', 'success');
    
                return redirect()->route('account.login');
            } else {
                
                return redirect()->route('account.changePassword')
                ->withInput()
                ->with('password_error', 'Mật khẩu không cũ chính xác! Vui lòng thử lại');
            }    

        }else{

            return redirect()->route('account.changePassword')
            ->withInput()
            ->withErrors($validator); 
            
        }
        

    }



    








}