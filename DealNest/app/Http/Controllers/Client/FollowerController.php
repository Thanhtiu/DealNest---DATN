<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Notifications\NewFollowerNotification;
use App\Models\Follower;
use App\Models\User;
use App\Models\Seller;

class FollowerController extends Controller
{

    public function index()
    {
        $userId = Session::get('userId');

        $listFollow = Follower::where('user_id', $userId)
            ->with(['seller', 'seller.products'])
            ->get();
        return view('client.follow', compact('listFollow'));
    }
    public function create(Request $request)
    {
        $userId = Session::get('userId');
        $sellerId = $request->seller_id;

        // Kiểm tra nếu bản ghi theo dõi đã tồn tại
        $follower = Follower::where('user_id', $userId)->where('seller_id', $sellerId)->first();

        if ($follower) {
            // Nếu đã theo dõi, hủy theo dõi
            $follower->delete();
            return response()->json(['success' => true, 'status' => 'removed', 'message' => 'Hủy theo dõi thành công.']);
        } else {
            // Nếu chưa theo dõi, thêm mới
            $newFollower = new Follower();
            $newFollower->user_id = $userId;
            $newFollower->seller_id = $sellerId;
            $newFollower->save();
            // Lấy thông tin của người dùng và người bán
            $user = User::find($userId);
            $seller = Seller::find($sellerId);

            // Gửi thông báo cho người bán
            $seller->notify(new NewFollowerNotification($user));
            return response()->json(['success' => true, 'status' => 'create', 'message' => 'Theo dõi người bán thành công.']);
        }
    }
}
