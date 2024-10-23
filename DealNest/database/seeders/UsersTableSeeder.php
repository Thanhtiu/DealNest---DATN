<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            User::create([
                'name' => $faker->userName,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password'), // Mật khẩu mặc định là 'password'
                'phone' => $faker->phoneNumber,
                'image' => $faker->imageUrl(100, 100), // Ảnh ngẫu nhiên
                'cccd' => $faker->numerify('##########'), // Tạo số CCCD ngẫu nhiên
                'role' => $faker->randomElement(['buyer', 'seller', 'admin']),
                'is_active' => $faker->boolean(80), // 80% kích hoạt
                'google_id' => null,
            ]);
        }
    }
}
