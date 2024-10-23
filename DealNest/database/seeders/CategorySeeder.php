<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run()
    {
        // Dữ liệu mẫu cho bảng categories, với parent_id là 0 cho các danh mục gốc
        $categories = [
            ['name' => 'Electronics', 'status' => 1, 'image' => 'electronics.jpg', 'parent_id' => 0, 'slug' => Str::slug('Electronics')],
            ['name' => 'Fashion', 'status' => 1, 'image' => 'fashion.jpg', 'parent_id' => 0, 'slug' => Str::slug('Fashion')],
            ['name' => 'Home & Garden', 'status' => 1, 'image' => 'home-garden.jpg', 'parent_id' => 0, 'slug' => Str::slug('Home & Garden')],
            ['name' => 'Sports', 'status' => 1, 'image' => 'sports.jpg', 'parent_id' => 0, 'slug' => Str::slug('Sports')],
            ['name' => 'Health & Beauty', 'status' => 1, 'image' => 'health-beauty.jpg', 'parent_id' => 0, 'slug' => Str::slug('Health & Beauty')],
            ['name' => 'Toys', 'status' => 1, 'image' => 'toys.jpg', 'parent_id' => 0, 'slug' => Str::slug('Toys')],
            ['name' => 'Automotive', 'status' => 1, 'image' => 'automotive.jpg', 'parent_id' => 0, 'slug' => Str::slug('Automotive')],
            ['name' => 'Books', 'status' => 1, 'image' => 'books.jpg', 'parent_id' => 0, 'slug' => Str::slug('Books')],
            ['name' => 'Groceries', 'status' => 1, 'image' => 'groceries.jpg', 'parent_id' => 0, 'slug' => Str::slug('Groceries')],
            ['name' => 'Music', 'status' => 1, 'image' => 'music.jpg', 'parent_id' => 0, 'slug' => Str::slug('Music')],
            // Các danh mục con có parent_id cụ thể
            ['name' => 'Computers', 'status' => 1, 'image' => 'computers.jpg', 'parent_id' => 1, 'slug' => Str::slug('Computers')],
            ['name' => 'Mobile Phones', 'status' => 1, 'image' => 'mobile-phones.jpg', 'parent_id' => 1, 'slug' => Str::slug('Mobile Phones')],
            ['name' => 'Men\'s Clothing', 'status' => 1, 'image' => 'mens-clothing.jpg', 'parent_id' => 2, 'slug' => Str::slug('Men\'s Clothing')],
            ['name' => 'Women\'s Clothing', 'status' => 1, 'image' => 'womens-clothing.jpg', 'parent_id' => 2, 'slug' => Str::slug('Women\'s Clothing')],
            ['name' => 'Furniture', 'status' => 1, 'image' => 'furniture.jpg', 'parent_id' => 3, 'slug' => Str::slug('Furniture')],
            ['name' => 'Garden Tools', 'status' => 1, 'image' => 'garden-tools.jpg', 'parent_id' => 3, 'slug' => Str::slug('Garden Tools')],
            ['name' => 'Fitness Equipment', 'status' => 1, 'image' => 'fitness-equipment.jpg', 'parent_id' => 4, 'slug' => Str::slug('Fitness Equipment')],
            ['name' => 'Skincare', 'status' => 1, 'image' => 'skincare.jpg', 'parent_id' => 5, 'slug' => Str::slug('Skincare')],
            ['name' => 'Board Games', 'status' => 1, 'image' => 'board-games.jpg', 'parent_id' => 6, 'slug' => Str::slug('Board Games')],
            ['name' => 'Car Accessories', 'status' => 1, 'image' => 'car-accessories.jpg', 'parent_id' => 7, 'slug' => Str::slug('Car Accessories')],
        ];

        // Tạo dữ liệu vào bảng categories
        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
