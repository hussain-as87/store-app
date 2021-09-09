<?php

namespace Database\Seeders;

use App\Models\Admin\Setting;
use Illuminate\Database\Seeder;

class SettingsVeriablesSedder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Setting::create([
            'name' => 'app_name',
            'value' => 'store',
        ]);
        Setting::create([
            'name' => 'local',
            'value' => 'ar',
        ]);
    }
}
