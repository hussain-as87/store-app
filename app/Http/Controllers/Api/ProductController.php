<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\ImageUpload;
use App\Models\Admin\Product;
use App\Models\Admin\ProductImage;
use App\Models\Admin\Tag;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    protected $product_path = 'public/products';

    public function __construct()
    {
        $this->middleware('permission:product-list|product-create|product-edit|product-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:product-create', ['only' => ['store']]);
        $this->middleware('permission:product-edit', ['only' => ['update']]);
        $this->middleware('permission:product-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|JsonResponse|\Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user()->currentAccessToken()->tokenable->id;
        $product = Product::with('category', 'product_images', 'user')->paginate(10);
        if ($product) {
            return new JsonResponse([
                'status' => '201',
                'product' => $product
            ]);
        } else {
            return new JsonResponse([
                'status' => '401',
                'product' => __('not found !')
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $user = \auth()->user()->currentAccessToken()->tokenable->id;
        $request->validate([
            'name.*' => 'required|max:200',
            'description.*' => 'sometimes|max:2000',
            'image' => 'sometimes|file|image',
            'gallery.*' => 'sometimes|file|image',
            'price' => 'required|max:1000000000',
            'category_id' => 'required',
            'gallery' => 'sometimes|max:1000000000',
        ]/*,[
            'name.required'=>'the name valid',
        ]*/);
        DB::beginTransaction();

        try {
            $product = new Product();
            $product->name = $request->name;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->category_id = $request->category_id;
            if ($request->hasFile('image')) {
                $image = ImageUpload::upload_image($request->image, $this->product_path);
                $product->image = $image;
            }
            $product->user_id = $user;
            $product->save();
            ///////
            if ($request->hasFile('gallery')) {
                $this->gallery($request, $product);
            }
            /////
            $this->SaveTag($request, $product);

            DB::commit();
        } catch (\Throwable $exception) {
            return new JsonResponse([
                'status' => '500',
                'message' => __($exception->getMessage())
            ]);
        }

        return new JsonResponse([
            'status' => '201',
            'message' => $product
        ]);
    }

    /**
     * Display the specified resource.
     * @param int $id
     * @return JsonResponse
     */
    public function show(Request $request)
    {
        $user = \auth()->user()->currentAccessToken()->tokenable->id;
        $product = Product::with('category', 'product_images', 'user')->where('id', $request->id)->first();
        if ($product) {
            return new JsonResponse([
                'status' => '201',
                'product' => $product
            ]);
        } else {
            return new JsonResponse([
                'status' => '500',
                'product' => __('not found !')
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request)
    {
        $user = \auth()->user()->currentAccessToken()->tokenable->id;
        $request->validate([
            'name.*' => 'required|max:200',
            'description.*' => 'sometimes|max:2000',
            'image' => 'sometimes|file|image',
            'gallery.*' => 'sometimes|file|image',
            'price' => 'required|max:1000000000',
            'category_id' => 'required',
            'gallery' => 'sometimes|max:1000000000',
        ]/*,[
            'name.required'=>'the name valid',
        ]*/);
        DB::beginTransaction();

        try {
            $product = Product::where('id', $request->id)->first();
            $product->name = $request->name;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->category_id = $request->category_id;
            if ($request->hasFile('image')) {
                $image = ImageUpload::upload_image($request->image, $this->product_path);
                $product->image = $image;
            }
            $product->user_id = $user;
            $product->update();
            ///////
            if ($request->hasFile('gallery')) {
                $this->gallery($request, $product);
            }
            /////
            $this->SaveTag($request, $product);

            DB::commit();
        } catch (\Throwable $exception) {
            return new JsonResponse([
                'status' => '500',
                'message' => __($exception->getMessage())
            ]);
        }
        return new JsonResponse([
            'status' => '201',
            'message' => $product
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(Request $request)
    {
        $user = auth()->user()->currentAccessToken()->tokenable->id;
        $product = Product::where('id', $request->id)->first();
        $gallery = ProductImage::where('product_id', $request->id)->get();
        DB::beginTransaction();
        try {
            foreach ($gallery as $img) {
                File::delete(public_path('storage/' . $img->path));
                $img->delete();
            }
            if ($product->image) {
                File::delete(public_path('storage/products/' . $product->image));
                $product->delete();
            }
            return new JsonResponse([
                'status' => '201',
                'message' => __('product deleted !')
            ]);
            DB::commit();
        } catch (\Throwable $exception) {
            return new JsonResponse([
                'status' => '401',
                'message' => __('not found !')
            ]);
        }
    }

    protected function SaveTag($request, $product)
    {
        $product_tag = [];
        $tags = explode(',', $request->post('tags'));
        foreach ($tags as $tag) {
            $tag = trim($tag);
            $tag_store = Tag::firstOrCreate(['name' => $tag]);
            /* DB::table('products_tags')->insert(['product_id' => $product->id, 'tag_id' => $tag_store->id]);*/
            $product_tag[] = $tag_store->id;
        }
        $product->tags()->sync($product_tag);/*syncWithoutDetaching, sync x toggle, attach,detach*/
    }

    protected function gallery($request, $product)
    {
        $images = $request->file('gallery');

        foreach ($images as $img) {
            $name = $img->getClientOriginalName();
            $path = $img->storeAs('products/gallery', $name, 'public');

            ProductImage::create([
                'product_id' => $product->id,
                'path' => $path,
            ]);
        }
    }
}
