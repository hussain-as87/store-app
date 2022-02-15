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
            'show' => '1',
            'photo' => '1639458917.jpg',
        ]);
        Category::create([
            'name' => [
                "en" => "women", "ar" => "سيدات"
            ],
            'show' => '1',
            'photo' => '1639458963.jpg',
        ]);
        Category::create([
            'name' => [
                "en" => "accessories", "ar" => "اكسسوارات"
            ],
            'show' => '1',
            'photo' => '1639458975.jpg',
        ]);

        /////////////////////////products

        Product::create([
            'name' => ["en" => "t-shart", "ar" => "قميص"],
            'price' => 250.25,
            'category_id' => 1,
            'user_id' => 1,
            'image'=>'1639460699.jpg'
        ]);
        Product::create([
            'name' => ["en" => "short", "ar" => "شورت"],
            'price' => 100.00,
            'category_id' => 1,
            'user_id' => 1,
            'image'=>'1639460699.jpg'

        ]);
        Product::create([
            'name' => ["en" => "laptop", "ar" => "حاسب شخصي"],
            'price' => 250.25,
            'category_id' => 3,
            'user_id' => 1,
            'image'=>'1641211399.jpg'

        ]);
        Product::create([
            'name' => ["en" => "product1", "ar" => "منتج1"],
            'price' => 200.25,
            'category_id' => 3,
            'user_id' => 1,
            'image'=>'1641211399.jpg'

        ]);
        Product::create([
            'name' => ["en" => "product2", "ar" => "منتج2"],
            'price' => 200.25,
            'category_id' => 3,
            'user_id' => 1,
            'image'=>'1641211399.jpg'

        ]);
        Product::create([
            'name' => ["en" => "product3", "ar" => "منتج3"],
            'price' => 200.25,
            'category_id' => 2,
            'user_id' => 1,
            'image'=>'1639465018.jpg'

        ]);

        Product::create([
            'name' => ["en" => "product4", "ar" => "منتج4"],
            'price' => 200.25,
            'category_id' => 2,
            'user_id' => 1,
            'image'=>'1639465018.jpg'

        ]);

        Product::create([
            'name' => ["en" => "product5", "ar" => "منتج5"],
            'price' => 200.25,
            'category_id' => 3,
            'user_id' => 1,
            'image'=>'1641211399.jpg'

        ]);

        Product::create([
            'name' => ["en" => "product6", "ar" => "منتج6"],
            'price' => 200.25,
            'category_id' => 2,
            'user_id' => 1,
            'image'=>'1639465018.jpg'

        ]);
        Product::create([
            'name' => ["en" => "product8", "ar" => "منتج8"],
            'price' => 200.25,
            'category_id' => 2,
            'user_id' => 1,
            'image'=>'1639465018.jpg'

        ]);
        Product::create([
            'name' => ["en" => "product10", "ar" => "منتج10"],
            'price' => 200.25,
            'category_id' => 2,
            'user_id' => 1,
            'image'=>'1639465018.jpg'

        ]);
        Product::create([
            'name' => ["en" => "product11", "ar" => "منتج11"],
            'price' => 200.25,
            'category_id' => 1,
            'user_id' => 1,
            'image'=>'1639460699.jpg'

        ]);
        Product::create([
            'name' => ["en" => "product12", "ar" => "منتج12"],
            'price' => 200.25,
            'category_id' => 1,
            'user_id' => 1,
            'image'=>'1639460699.jpg'

        ]);
        Product::create([
            'name' => ["en" => "product21", "ar" => "منتج21"],
            'price' => 200.25,
            'category_id' => 1,
            'user_id' => 1,
            'image'=>'1639460699.jpg'

        ]);
    }
}
