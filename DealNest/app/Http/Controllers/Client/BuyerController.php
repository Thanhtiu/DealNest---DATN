<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Buyer;

class BuyerController extends Controller
{

    public function index()
    {
        $userId = auth()->id();

        $listFollow = Buyer::where('user_id', $userId)
            ->with(['seller', 'seller.products'])
            ->get();
        return view('client.follow', compact('listFollow'));
    }
    public function followSeller(Request $request)
    {
        $userId = auth()->id();
        $sellerId = $request->seller_id;

        $isFollowing = Buyer::where('user_id', $userId)
            ->where('seller_follow_id', $sellerId)
            ->first();

        if (!$isFollowing) {
            Buyer::create([
                'user_id' => $userId,
                'seller_follow_id' => $sellerId,
            ]);

            return response()->json([
                'success' => true,
                'status' => 'added',
                'message' => 'Bạn đã theo dõi cửa hàng!'
            ]);
        } else {
            $isFollowing->delete();

            return response()->json([
                'success' => true,
                'status' => 'removed',
                'message' => 'Bạn đã hủy theo dõi cửa hàng!'
            ]);
        }
    }
}
