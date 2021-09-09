<?php

namespace Database\Seeders;

use App\Models\Admin\Category;
use App\Models\Admin\Product;
use Illuminate\Database\Seeder;

class CreateCategoriesAndProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ////////////categories
        Category::create([
            'name' => [
                "en" => "men", "ar" => "رجال"
            ],
            'show' => '1'
        ]);
        Category::create([
            'name' => [
                "en" => "women", "ar" => "رجال"
            ],
            'show' => '1'
        ]);
        Category::create([
            'name' => [
                "en" => "kids", "ar" => "رجال"
            ],
            'show' => '1'
        ]);
        Category::create([
            'name' => [
                "en" => "computers", "ar" => "رجال"
            ],
            'show' => '1'
        ]);
        Category::create([
            'name' => [
                "en" => "foods", "ar" => "رجال"
            ],
            'show' => '1'
        ]);
        Category::create([
            'name' => [
                "en" => "games", "ar" => "رجال"
            ],
            'show' => '1'
        ]);
        /////////////////////////products

        Product::create([
            'name' => ["en" => "t-shart", "ar" => "قميص"],
            'price' => 250.25,
            'category_id' => 1,
            'user_id' => 1,
        ]);
        Product::create([
            'name' => ["en" => "short", "ar" => "شورت"],
            'price' => 100.00,
            'category_id' => 1,
            'user_id' => 1,
        ]);
        Product::create([
            'name' => ["en" => "laptop", "ar" => "حاسب شخصي"],
            'price' => 250.25,
            'category_id' => 5,
            'user_id' => 1,
        ]);
        Product::create([
            'name' => ["en" => "product1", "ar" => "منتج1"],
            'price' => 200.25,
            'category_id' => 3,
            'user_id' => 1,
        ]);
        Product::create([
            'name' => ["en" => "product2", "ar" => "منتج2"],
            'price' => 200.25,
            'category_id' => 3,
            'user_id' => 1,
        ]);
        Product::create([
            'name' => ["en" => "product3", "ar" => "منتج3"],
            'price' => 200.25,
            'category_id' => 4,
            'user_id' => 1,
        ]);

        Product::create([
            'name' => ["en" => "product4", "ar" => "منتج4"],
            'price' => 200.25,
            'category_id' => 4,
            'user_id' => 1,
        ]);

        Product::create([
            'name' => ["en" => "product5", "ar" => "منتج5"],
            'price' => 200.25,
            'category_id' => 6,
            'user_id' => 1,
        ]);

        Product::create([
            'name' => ["en" => "product6", "ar" => "منتج6"],
            'price' => 200.25,
            'category_id' => 6,
            'user_id' => 1,
        ]);
        Product::create([
            'name' => ["en" => "product8", "ar" => "منتج8"],
            'price' => 200.25,
            'category_id' => 6,
            'user_id' => 1,
        ]);
        Product::create([
            'name' => ["en" => "product10", "ar" => "منتج10"],
            'price' => 200.25,
            'category_id' => 6,
            'user_id' => 1,
        ]);
        Product::create([
            'name' => ["en" => "product11", "ar" => "منتج11"],
            'price' => 200.25,
            'category_id' => 6,
            'user_id' => 1,
        ]);
        Product::create([
            'name' => ["en" => "product12", "ar" => "منتج12"],
            'price' => 200.25,
            'category_id' => 2,
            'user_id' => 1,
        ]);
        Product::create([
            'name' => ["en" => "product21", "ar" => "منتج21"],
            'price' => 200.25,
            'category_id' => 5,
            'user_id' => 1,
        ]);
    }
}
