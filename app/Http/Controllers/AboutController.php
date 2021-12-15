<?php

namespace App\Http\Controllers;

use App\ImageUpload;
use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $about = About::with('user')->first();
        return view('admin.about.index', compact('about'));
    }
    public function edit()
    {
        $about = About::with('user')->where('user_id', 1)->where('id', 1)->first();
        return view('admin.about.edit', compact('about'));
    }
    public function update(Request $request)
    {
        $request->validate([
            'store.*' => 'required',
            'service.*' => 'required',
            'store_image' => 'sometimes|file|image|mimes:png,jpg,jepg',
            'service_image' => 'sometimes|file|image|mimes:png,jpg,jepg',
        ]);
        $about = About::with('user')->where('user_id', 1)->where('id', 1)->first();
        $data['story'] = $request->story;
        $data['service'] = $request->service;
        if ($request->hasFile('story_image')) {
            $image = ImageUpload::upload_image($request->story_image, 'public/images/about/');
            $data['story_image'] = $image;
        }
        if ($request->hasFile('service_image')) {
            $image = ImageUpload::upload_image($request->service_image, 'public/images/about/');
            $data['service_image'] = $image;
        }
        $process = $about->update($data);
        if (!$process) {
            toast('have problem with input parameters !!!', 'error');
            return redirect()->back();
        } else {
            toast('Successfully saved !!!', 'success');
            return redirect()->back();
        }
    }
}
