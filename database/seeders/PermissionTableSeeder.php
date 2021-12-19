<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'user-per',
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'coupon-list',
            'coupon-create',
            'coupon-edit',
            'coupon-delete',
            'category-list',
            'category-create',
            'category-edit',
            'category-delete',
            'category-trash',
            'product-list',
            'product-create',
            'product-edit',
            'product-delete',
            'product-trash',
            'advert-list',
            'advert-create',
            'advert-edit',
            'advert-delete',
            'settings-list',
            'settings-edit',
            'about-list',
            'about-edit',

        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
