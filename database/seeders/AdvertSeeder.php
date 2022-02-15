<?php

namespace Database\Seeders;

use App\Models\Advert;
use Illuminate\Database\Seeder;

class AdvertSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Advert::create([
            'title' => ["ar" => "موسم جديد", "en" => "new session"],
            'content' => ["ar" => "", "en" => ""],
            'photo' => '1641210984.jpg',
            'user_id' => 1
        ]);
        Advert::create([
            'title' => ["ar" => "موسم جديد", "en" => "new session"],
            'content' => ["ar" => "", "en" => ""],
            'photo' => '1641211012.jpg',
            'user_id' => 1
        ]);
        Advert::create([
            'title' => ["ar" => "موسم جديد", "en" => "new session"],
            'content' => ["ar" => "", "en" => ""],
            'photo' => '1641211053.jpg',
            'user_id' => 1
        ]);
    }
}
