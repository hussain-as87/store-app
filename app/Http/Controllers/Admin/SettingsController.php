<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Admin\Setting;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Cache\Factory;

class SettingsController extends Controller
{
    public function __construct()
    {
        /* $this->authorizeResource(Product::class, 'product'); */
        $this->middleware('permission:settings-list', ['only' => ['index']]);
        $this->middleware('permission:settings-edit', ['only' => ['edit', 'update']]);
    }
    public function index()
    {
        $settings = Setting::all();
        return view('Admin\setting\index', compact('settings'));
    }


    public function edit($id)
    {
        $setting = Setting::find($id);
        return view('Admin\setting\edit', compact('setting'));
    }

    public function update(Request $request, Factory $cache, $id)
    {
        $setting = Setting::find($id);

        if ($request->isMethod('put')) {
            $request->validate(['value' => 'required']);

            $setting->value = $request->value;
            $setting->update();
            // When the settings have been updated, clear the cache for the key 'settings'
            $cache->forget('settings');
            toast('Successfully Save !!', 'success');
            return redirect()->route('settings.index')->with('success', 'Item has been updated successfully.');
        }
    }
}
