<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Seller;
use App\Models\User;
use App\Models\Address;
use Faker\Factory as Faker;

class SellersTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $users = User::all(); // Lấy tất cả users đã tạo
        $addresses = Address::all(); // Lấy tất cả addresses đã tạo

        foreach ($users as $user) {
            // Chọn ngẫu nhiên một địa chỉ cho seller
            $address = $addresses->random();

            Seller::create([
                'user_id' => $user->id,
                'address_id' => $address->id,
                'name' => $faker->company,
                'description' => $faker->catchPhrase,
                'join' => $faker->date,
                'store_email' => $faker->companyEmail,
                'store_phone' => substr($faker->phoneNumber, 0, 15), // Giới hạn 15 ký tự
                'logo' => $faker->imageUrl(100, 100, 'business'), // Giả sử logo là hình ảnh
                'background' => $faker->imageUrl(800, 600, 'business'), // Hình nền cửa hàng
                'note' => $faker->sentence,
                'status' => $faker->boolean(80), // 80% là cửa hàng hoạt động
            ]);
        }
    }
}
