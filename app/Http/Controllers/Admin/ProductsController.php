<?php

namespace App\Http\Controllers\Admin;

use Throwable;
use App\ImageUpload;
use App\Models\Admin\Tag;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Admin\Product;
use App\Models\PriceDiscount;
use App\Models\Admin\Category;
use App\Models\Admin\ProductImage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Http\Requests\ProductRequest;

class ProductsController extends BaseController
{
    protected $product_path = 'public/products';

    public function __construct()
    {
        /* $this->authorizeResource(Product::class, 'product'); */
        $this->middleware('permission:product-list|product-create|product-edit|product-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:product-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:product-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:product-delete', ['only' => ['destroy']]);
        $this->middleware('permission:product-trash', ['only' => ['trash', 'restore', 'forceDelete']]);
    }

    public function index()
    {
        return view('admin.product.index');
    }

    public function show(Product $product)
    {

        return $product;
    }

    public function create(Product $product)
    {
        $category = Category::where('show', '1')->get();
        return view('admin.product.create', compact('product', 'category'));
    }

    public function store(ProductRequest $request)
    {

        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->additional_information = $request->additional_information;
        $product->category_id = $request->category_id;
        if ($request->hasFile('image')) {
            $image = ImageUpload::upload_image($request->image, $this->product_path);
            $product->image = $image;
        }
        $product->user_id = auth()->id();
        $product->save();
        ///////
        if ($request->hasFile('gallery')) {
            $this->gallery($request, $product);
        } ////////for discount
        /////
        $this->SaveTag($request, $product);
        if ($product) {
            toast('Successfully', 'success');
            return redirect()->route('products.index');
        } else {
            toast('Error!!', 'error');
            return redirect()->back();
        }
    }

    public function edit(Product $product)
    {
        $category = Category::where('show', '1')->get();

        return view('admin.product.edit', compact('product', 'category'));
    }

    public function update(ProductRequest $request, Product $product)
    {
        $this->getValidation($request);
        $new_price = null;
        if ($request->post('percentage')) {
            $per = '0.' . request()->percentage;
            $old_price = $per * $request->price;
            $new_price = $request->price - $old_price;
            $dis = PriceDiscount::where('product_id', $product->id)->first();
            if ($dis != null) {

                $dis->percentage = $per;
                $dis->price = $new_price;
                $dis->product_id = $product->id;
                $dis->update();
            } else {
                $dis = new PriceDiscount();
                $dis->percentage = $per;
                $dis->price = $new_price;
                $dis->product_id = $product->id;
                $dis->save();
            }
        }
        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'additional_information' => $request->additional_information,
            'price' => $request->post('percentage') ? $new_price : $request->price,
            'category_id' => $request->category_id,
            'user_id' => auth()->id(),
        ]);
        if ($request->hasFile('image')) {
            $image = ImageUpload::upload_image($request->image, $this->product_path);
            $product->update(['image' => $image]);
        }

        if ($request->hasFile('gallery')) {
            $this->gallery($request, $product);
        }
        $this->SaveTag($request, $product);


        if ($product) {
            toast('Successfully', 'success');
            return redirect()->route('products.index');
        } else {
            toast('Error!!', 'error');
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);


        if ($product->image) {
            $product->delete();
        }
        toast('Delete!', 'error');
        return redirect()->back();
        DB::commit();
    }

    public function trash()
    {
        $product = Product::with('user.store', 'category')->onlyTrashed()->orderByDesc('id')->paginate(5);
        return view('admin.product.trash', compact('product'));
    }

    public function restore($id)
    {
        $product = Product::withTrashed()->findOrFail($id)->restore();
        toast(__('restore : ') . $id, 'success');
        return redirect()->route('products.index');
    }

    public function forceDelete($id)
    {

        $product = Product::withTrashed()->findOrFail($id);
        $gallery = ProductImage::where('product_id', $id)->get();

        foreach ($gallery as $img) {
            File::delete(public_path('storage/' . $img->path));
            $img->delete();
        }
        if ($product->image) {
            File::delete(public_path('storage/products/' . $product->image));
            $product->forceDelete();
        }
        toast(__('deleted !'), 'error');
        return redirect()->back();
    }


    public function destroy_gallery(ProductImage $gallery)
    {
        //$gallery = ProductImage::findOrFail($image)->first();

        File::delete(public_path('storage/' . $gallery->path));
        $gallery->delete();
        toast('Delete!', 'error');
        return redirect()->back();
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

    protected function getValidation(Request $request)
    {
        return $request->validate([
            'name.*' => 'required|max:200',
            'description.*' => 'sometimes|max:2000',
            'image' => 'sometimes|file|image|mimes:png,jpg,jepg',
            'gallery.*' => 'sometimes|file|image',
            'price' => 'required|max:1000000000',
            'color' => 'sometimes',
            'size' => 'sometimes',
            'category_id' => 'required',
            'gallery' => 'sometimes|max:1000000000',
        ]);
    }
}
