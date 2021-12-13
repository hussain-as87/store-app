<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\About;
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
        About::create([
            'id' => 1,
            'user_id' => $user->id,
            'story' => [
                        "en" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris consequat consequat enim, non
                                 auctor massa ultrices non. Morbi sed odio massa. Quisque at vehicula tellus, sed tincidunt
                                 augue. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
                                 Maecenas varius egestas diam, eu sodales metus scelerisque congue. Pellentesque habitant morbi
                                 tristique senectus et netus et malesuada fames ac turpis egestas. Maecenas gravida justo eu arcu
                                 egestas convallis. Nullam eu erat bibendum, tempus ipsum eget, dictum enim. Donec non neque ut
                                 enim dapibus tincidunt vitae nec augue. Suspendisse potenti. Proin ut est diam. Donec
                                 condimentum euismod tortor, eget facilisis diam faucibus et. Morbi a tempor elit.
                                 Donec gravida lorem elit, quis condimentum ex semper sit amet. Fusce eget ligula magna. Aliquam
                                 aliquam imperdiet sodales. Ut fringilla turpis in vehicula vehicula. Pellentesque congue ac orci
                                 ut gravida. Aliquam erat volutpat. Donec iaculis lectus a arcu facilisis, eu sodales lectus
                                 sagittis. Etiam pellentesque, magna vel dictum rutrum, neque justo eleifend elit, vel tincidunt
                                 erat arcu ut sem. Sed rutrum, turpis ut commodo efficitur, quam velit convallis ipsum, et
                                 maximus enim ligula ac ligula.
                                 Any questions? Let us know in store at 8th floor, 379 Hudson St, New York, NY 10018 or call us
                                 on (+1) 96 716 6879",
                        "ar" => "بلبيلبيلبيل"
                            ],
             'service' => [
                           "en" => " Mauris non lacinia magna. Sed nec lobortis dolor. Vestibulum rhoncus dignissim risus, sed
                                     consectetur erat. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac
                                     turpis egestas. Nullam maximus mauris sit amet odio convallis, in pharetra magna gravida.
                                     Praesent sed nunc fermentum mi molestie tempor. Morbi vitae viverra odio. Pellentesque ac velit
                                     egestas, luctus arcu non, laoreet mauris. Sed in ipsum tempor, consequat odio in, porttitor
                                     ante. Ut mauris ligula, volutpat in sodales in, porta non odio. Pellentesque tempor urna vitae
                                     mi vestibulum, nec venenatis nulla lobortis. Proin at gravida ante. Mauris auctor purus at lacus
                                     maximus euismod. Pellentesque vulputate massa ut nisl hendrerit, eget elementum libero iaculis.
                                     Creativity is just connecting things. When you ask creative people how they did something,
                                     they feel a little guilty because they didnt really do it, they just saw something.
                                     It
                                     seemed obvious to them after a while.
                                      Steve Job’s",
                            "ar" => "بلبيلبيلبيل"
                            ],
                            'story_image' =>'about-01.jpg',
                            'service_image' =>'about-02.jpg',

        ]);
    }
}
