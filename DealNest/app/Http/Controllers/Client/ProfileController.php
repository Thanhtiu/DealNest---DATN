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
        // Find the user by ID
        $user = User::find($id);
        $user->full_name = $request->full_name;
        $user->phone = $request->phone;


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
