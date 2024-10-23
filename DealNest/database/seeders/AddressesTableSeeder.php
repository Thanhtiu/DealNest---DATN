<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Address;
use App\Models\User;
use Faker\Factory as Faker;

class AddressesTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $users = User::all(); // Lấy tất cả users đã tạo
    
        foreach ($users as $user) {
            Address::create([
                'user_id' => $user->id,
                'province_id' => $faker->numberBetween(1, 63), // Giả sử có 63 tỉnh
                'district_id' => $faker->numberBetween(1, 700), // Giả sử có 700 quận huyện
                'ward_id' => $faker->numberBetween(1, 10000), // Giả sử có 10.000 phường xã
                'street' => $faker->streetAddress,
                'string_address' => $faker->address,
                'active' => $faker->boolean(90), // 90% là địa chỉ chính
                'phone' => substr($faker->phoneNumber, 0, 15), // Giới hạn 15 ký tự
                'name' => $faker->name,
            ]);
        }
    }
    
}
