<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Admin\Profile;
use Illuminate\Database\Seeder;
use Database\Seeders\AboutSeeder;
use Database\Seeders\AdvertSeeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            PermissionTableSeeder::class,
            CreateAdminUserSeeder::class,
            SettingSeder::class,
            CreateCategoriesAndProductsSeeder::class,
            //AboutSeeder::class,
            AdvertSeeder::class
        ]);
    }
}
