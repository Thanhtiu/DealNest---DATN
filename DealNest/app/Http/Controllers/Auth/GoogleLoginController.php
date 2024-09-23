<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Address;

class GoogleLoginController extends Controller
{
    /**
     * Redirect to Google for authentication.
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Handle response from Google.
     */
    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->stateless()->setHttpClient(new \GuzzleHttp\Client(['verify' => false]))->user();

            // Cập nhật hoặc tạo mới người dùng với google_id
            $authUser = User::updateOrCreate(
                ['google_id' => $user->id],
                [
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id' => $user->id,
                    'role' => 'buyer',
                    'password' => 123,
                    'full_name' => $user->name,
                ]
            );

            Auth::login($authUser, true);
            Session::put('userId', $authUser->id);
            Session::put('userFullName', $authUser->full_name);
            $address = Address::where('user_id', $authUser->id)
                ->where('active', 1)
                ->first();
            if ($address) {
                $string_address = $address->string_address;
                session()->put('stringAddress', $string_address);
            }
            return redirect()->route('client.index')->with('success', 'Đăng nhập thành công');
        } catch (\Exception $e) {
            dd($e->getMessage(), $e->getFile(), $e->getLine());
        }
    }

}


