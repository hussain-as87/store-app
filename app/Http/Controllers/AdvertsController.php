<?php

namespace App\Http\Controllers;

use App\ImageUpload;
use App\Models\Advert;
use Illuminate\Http\Request;
use SebastianBergmann\Environment\Console;

class AdvertsController extends Controller
{
    public function __construct()
    {
        /* $this->authorizeResource(Product::class, 'product'); */
        $this->middleware('permission:advert-list|advert-create|advert-edit|advert-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:advert-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:advert-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:advert-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('adverts.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Advert $advert)
    {
        return view('adverts.create',compact('advert'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:100',
            'content' => 'required|max:150',
            'photo' => 'required|file|image|mimes:png,jpg,jepg'
        ]);

        $data['title'] = $request->title;
        $data['content'] = $request->content;
        $data['user_id'] = $request->user()->id;
        if ($request->hasFile('photo')) {
            $photo = ImageUpload::upload_image($request->photo, 'public/advertis');
            $data['photo'] = $photo;
        }

       $advert = Advert::create($data);

       if ($advert) {
        toast('Successfully Saved !!', 'success');
        return redirect()->back();
    } else {
        toast('Error !!', 'error');
        return redirect()->back();
    }
}


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $advert = Advert::where('id', $id)->first();
        return view('adverts.edit', compact('advert'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'title' => 'required|max:100',
            'content' => 'required|max:150',
            'photo' => 'sometimes|file|image|mimes:png,jpg,jepg'
        ]);
        $data['title'] = $request->title;
        $data['content'] = $request->content;
        $data['user_id'] = auth()->id();
        if ($request->hasFile('photo')) {
            $photo = ImageUpload::upload_image($request->photo, 'public/advertis');
            $data['photo'] = $photo;
        }
        $ad = Advert::where('id',$id)->update($data);
        if ($ad) {
            toast('Successfully Updated !!', 'success');
            return redirect()->back();
        } else {
            toast('Error !!', 'error');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $advert = Advert::where('id', $id)->first()->destroy();
        if ($advert) {
            toast('Deleted !!', 'error');
            return redirect()->back();
        } else {
            toast('Error !!', 'waraning');
            return redirect()->back();
        }
    }
}
