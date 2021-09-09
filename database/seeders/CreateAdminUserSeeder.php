<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Admin\Profile;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'hussein sim',
            'email' => 'adda5mad@outlook.com',
            'password' => Hash::make('22444488'),
            'status' => 1
        ]);
        Profile::create([
            'user_id' => $user->id,
            'first_name' => 'hussein',
            'last_name' => 'sim',
            'phone' => '970566170044',
            'address' => 'Gaza',
            'country' => 'palestine',
        ]);
        $roles = Role::create(['name' => 'Super-Admin']);
        $permission = Permission::pluck('id', 'id')->all();
        $roles->syncPermissions($permission);
        $user->assignRole([$roles->id]);
    }
}
