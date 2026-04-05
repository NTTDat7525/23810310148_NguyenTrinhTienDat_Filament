<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Điện thoại',
                'slug' => 'dien-thoai',
                'description' => 'Các sản phẩm điện thoại di động',
            ],
            [
                'name' => 'Laptop',
                'slug' => 'laptop',
                'description' => 'Máy tính xách tay và laptop',
            ],
            [
                'name' => 'Phụ kiện',
                'slug' => 'phu-kien',
                'description' => 'Các phụ kiện công nghệ',
            ],
            [
                'name' => 'Tablet',
                'slug' => 'tablet',
                'description' => 'Thiết bị bảng điều khiển',
            ],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }
    }
}
