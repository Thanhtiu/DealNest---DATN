<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Review_image;
use Illuminate\Support\Facades\Session;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        // Tạo đánh giá mới
        $review = new Review();
        $userId = Session::get('userId');
        $review->product_id = $request->product_id;
        $review->classify = $request->classify;
        $review->user_id = $userId;
        $review->rating = $request->rating;
        $review->description = $request->description;
        $review->save();

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('uploads/reviews'), $imageName);
                $imagePath =  $imageName;
                $reviewImage = new Review_image();
                $reviewImage->review_id = $review->id;
                $reviewImage->image = $imagePath;
                $reviewImage->save();
            }
        }


        return redirect()->back()->with('success', 'Gửi đánh giá thành công!');
    }
}
