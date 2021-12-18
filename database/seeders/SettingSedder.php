<?php

namespace Database\Seeders;

use App\Models\Admin\Setting;
use Illuminate\Database\Seeder;

class SettingSedder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    Setting::create(['name' =>'website_name', 'value'=>'Coza Store']);
    Setting::create(['name' =>'time_zone', 'value'=>'Asia/Jerusalem']);
    Setting::create(['name' =>'language', 'value'=>'ar']);
    Setting::create(['name' =>'email', 'value'=>'adda5mad@outlook.com']);
    Setting::create(['name' =>'mobile', 'value'=>'+970566170044']);
    Setting::create(['name' =>'facebook', 'value'=>'https://www.facebook.com/hussein.sim.37/']);
    Setting::create(['name' =>'instagram', 'value'=>'https://www.instagram.com/hussein.sim87/?hl=en']);
    Setting::create(['name' =>'twitter', 'value'=>'https://twitter.com/hussein_sim87']);
    Setting::create(['name' =>'logo', 'value'=>'images/icons/logo-01.png']);
    Setting::create(['name' =>'address', 'value'=>'palestine']);
    }
}
