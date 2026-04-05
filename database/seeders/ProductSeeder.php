<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tạo một số danh mục nếu chưa có
        $categories = Category::all();

        if ($categories->isEmpty()) {
            $this->call(CategorySeeder::class);
            $categories = Category::all();
        }

        // Tạo sản phẩm cho mỗi danh mục
        foreach ($categories as $category) {
            Product::factory(5)
                ->published()
                ->create([
                    'category_id' => $category->id,
                ]);
        }

        // Tạo một số sản phẩm nháp
        Product::factory(3)
            ->create();

        // Tạo một số sản phẩm hết hàng
        Product::factory(2)
            ->outOfStock()
            ->create();
    }
}
