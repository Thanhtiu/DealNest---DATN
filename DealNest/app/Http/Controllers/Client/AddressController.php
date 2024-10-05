<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Address;

class AddressController extends Controller
{
    public function index()
    {

        $userId = auth()->id();
        $address = Address::where('user_id', auth()->id())
            ->with('user')
            ->orderBy('active', 'desc')
            ->get();
        return view('client.address', compact('address'));
    }
    public function create(Request $request)
    {
        // Kiểm tra xem có địa chỉ nào có `active = 1` cho người dùng hiện tại hay không
        $existingActiveAddress = Address::where('user_id', auth()->user()->id)
            ->where('active', 1)
            ->first();

        // Nếu đã có địa chỉ `active = 1`, thì gán giá trị `active = 2` cho địa chỉ mới
        $activeValue = $existingActiveAddress ? 2 : 1;

        // Tạo địa chỉ mới
        $address = Address::create([
            'user_id' => auth()->user()->id,
            'province_id' => $request->input('province'),
            'district_id' => $request->input('district'),
            'ward_id' => $request->input('ward'),
            'street' => $request->input('street'),
            'string_address' => $request->input('string_address'),
            'active' => $activeValue,
            'name' => $request->name,
            'phone' => $request->phone,
        ]);

        return redirect()->route('account.address.index')->with('success', 'Địa chỉ đã được thêm thành công');
    }


    public function edit($id)
    {
        $address = Address::find($id);
        if (!$address) {
            return response()->json(['error' => 'Địa chỉ không tồn tại.'], 404);
        }

        return response()->json([
            'province' => $address->province_id,
            'district' => $address->district_id,
            'ward' => $address->ward_id,
            'street' => $address->street,
            'string_address' => $address->string_address,
            'phone' => $address->phone,
            'name' => $address->name,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $address = Address::find($id);
        $addressUser = Address::where('user_id', auth()->id())->get();
        foreach ($addressUser as $item) {
            if ($item->active == 1) {
                $item->active = 1;
            }
        }

        $address->update($request->all());
        return redirect()->back()->with('success', 'Cập nhật địa chỉ thành công');
    }

    public function delete($id)
    {
        $address = Address::find($id);
        $address->delete();
        return redirect()->back()->with('success', 'Xóa địa chỉ thành công');
    }

    public function setDefault($id)
    {

        $address = Address::find($id);

        if (!$address) {
            return redirect()->back()->with('error', 'Địa chỉ không tồn tại.');
        }

        $addressUser = Address::where('user_id', auth()->id())->get();

        if ($address->active === 1) {
            return redirect()->back()->with('success', 'Địa chỉ này đã mặc định');
        }

        foreach ($addressUser as $item) {
            if ($item->active == 1) {
                $item->active = 0;
                $item->save();
            }
        }

        $address->active = 1;
        $address->save();

        return redirect()->back()->with('success', 'Địa chỉ đã được thiết lập mặc định');
    }
}
