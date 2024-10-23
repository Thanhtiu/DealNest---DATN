<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\Country;
use App\Models\Seller;
use Faker\Factory as Faker;

class ProductsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $sellers = Seller::all(); // Lấy tất cả sellers đã tạo
        $categories = Category::all(); // Lấy tất cả categories đã tạo
        $countries = Country::all(); // Lấy tất cả countries đã tạo

        // Kiểm tra nếu không có seller, category hoặc country nào
        if ($sellers->isEmpty() || $categories->isEmpty() || $countries->isEmpty()) {
            echo "Không có dữ liệu seller, category hoặc country để tạo product.\n";
            return;
        }

        foreach (range(1, 100) as $index) {
            $seller = $sellers->random();
            $category = $categories->random();
            $country = $countries->random(); // Lấy country ngẫu nhiên

            Product::create([
                'name' => $faker->words(3, true), // Tạo tên sản phẩm ngẫu nhiên
                'seller_id' => $seller->id,
                'category_id' => $category->id,
                'country_id' => $country->id, // Sử dụng country_id
                'slug' => $faker->slug, // Tạo slug ngẫu nhiên
                'description' => $faker->paragraph, // Tạo mô tả sản phẩm ngẫu nhiên
                'price' => $faker->randomFloat(2, 10, 1000), // Giá từ 10 đến 1000
                'mrp' => $faker->randomFloat(2, 10, 1500), // Giá niêm yết từ 10 đến 1500
                'image' => $faker->imageUrl(300, 300, 'products'), // URL ảnh sản phẩm ngẫu nhiên
                'quantity' => $faker->numberBetween(1, 500), // Số lượng từ 1 đến 500
                'view' => $faker->numberBetween(0, 10000), // Lượt xem từ 0 đến 10000
                'sku' => strtoupper($faker->lexify('SKU-??????')), // Tạo SKU ngẫu nhiên
                'sales' => $faker->numberBetween(0, 1000), // Số lượng đã bán từ 0 đến 1000
                'trash_can' => $faker->boolean(10), // 10% là đã xóa
                'note' => $faker->sentence, // Ghi chú ngẫu nhiên
                'status' => $faker->randomElement(['pending', 'approved', 'cancel']), // Trạng thái
            ]);
        }
    }
}
