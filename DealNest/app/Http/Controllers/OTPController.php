<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class OTPController extends Controller
{
    public function index(Request $request){

        $userEmail = $request->session()->get('userEmail'); 

        $checkUser = User::where('email',$userEmail)->first();

        if(is_null($checkUser)){

            session()->flash('alertMessage', 'Email hiện không tồn tại vui lòng kiểm tra lại!');
            session()->flash('alertType', 'error');

            return redirect()->route('account.register');
            
        }else{
            return view('account.otp');
        }
        
    }

    public function sendOTP(Request $request){

        $otp = rand(100000, 999999);

        $userEmail = $request->session()->get('userEmail');

        $user = User::where('email', $userEmail)->first();

        if ($user) {
            Mail::send('emails.sendOTPView', ['otp' => $otp], function ($message) use ($userEmail) {
                $message->to($userEmail);
                $message->subject('Xác thực OTP');
            });

            $user->otp = $otp;

            $user->save();
            
            return redirect()->route('otp.index');
        } else {

            return redirect()->route('account.login')->with('login_error','Không tìm thấy người dùng với email này.');
        }

    }

    public function verifyOTP(Request $request){
        

        $userEmail = $request->session()->get('userEmail'); 

        $checkUser = User::where('email',$userEmail)->first();

        if(is_null($checkUser)){

            session()->flash('alertMessage', 'Email hiện không tồn tại vui lòng kiểm tra lại!');
            session()->flash('alertType', 'error');

            return redirect()->route('account.register');
            
        }else{

            $validator =  Validator::make($request->all(),[
                'otp' => 'required|numeric'
            ],[
                'otp.required' => "Không được để trống OTP.",
                'otp.numeric' => "Mã OTP phải ở dạng số!"
            ]);

            if($validator->passes()){

                $otp = $request->otp;

                if($checkUser->otp == $otp){

                    if(session()->has('forgotPassword')){

                        // code tiep o day nè

                    }else{

                        $checkUser->is_active = 1;

                        $checkUser->save();
    
                        session()->flash('alertMessage', 'Xác thực tài khoản thành công!');
                        session()->flash('alertType', 'success');
                        return redirect()->route('account.login');
                    }

                    
                }else{

                    session()->flash('otp_error','Mã xác thực không chính xác vui lòng thử lại!');

                    return redirect()->route('otp.index')
                    ->withErrors($validator); 
                }

            }else{     
                return redirect()->route('otp.index')
                ->withErrors($validator);
            }


        }     
        
    }


}