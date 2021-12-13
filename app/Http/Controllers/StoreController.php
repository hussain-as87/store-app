<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\About;
use App\Models\Store;
use Ramsey\Uuid\Uuid;
use App\Models\Advert;
use Illuminate\Http\Request;
use App\Models\Admin\Product;
use App\Models\PriceDiscount;
use App\Models\Admin\Category;
use App\Models\favoriteProduct;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Store $store, Product $product)
    {
        $user = Auth::id();
        $cart = Cart::with('product')->where('id', $this->getCartId())
            ->when($user, function ($query, $user) {
                $query->where('user_id', $user)->orWhereNull('user_id');
            })
            ->get();
        $item_count = $cart->count();

        $advert = Advert::orderByDesc('id')->paginate(5);
        /** if i want to bring a relation in another relation With('user.store,gallery') */
        $categories = Category::paginate(3);

        $top_sales = Product::/*withoutGlobalScope('ordered')->*/ TopSales(10);
        //$expensive_sales=Product::highPrice(120,500)->get();
        $products = Product::with('category.subcategories', 'product_images', 'user')->orderByDesc('updated_at')->paginate(10);
        return view('store.home', compact('advert', 'product', 'products', 'categories', 'top_sales', 'cart', 'item_count'));
    }


    public function productShow(Product $product)
    {
        $user = Auth::id();
        $cart = Cart::with('product')->where('id', $this->getCartId())
            ->when($user, function ($query, $user) {
                $query->where('user_id', $user)->orWhereNull('user_id');
            })
            ->get();

        $new_price = PriceDiscount::where('product_id', $product->id)->first();

        $item_count = $cart->count();

        $propducts_cate = Product::where('category_id', $product->category_id)->orderByDesc('updated_at')->get();

        $favorite = favoriteProduct::where('product_id', $product->id)->where('user_id', auth()->id())->first();

        return view('store', compact('propducts_cate', 'product', 'cart', 'item_count', 'new_price', 'favorite'));
    }


    protected function getCartId()
    {
        $id = \request()->cookie('cart_id');
        if (!$id) {
            $uuid = Uuid::uuid1();
            $id = $uuid->toString();
            Cookie::queue(Cookie::make('cart_id', $id, 43800));
        }/*get cart id from cookie*/
        return $id;
    }


    public function search(Request $request)
    {
        $request->validate([
            'search_value' => 'required'
        ]);

        $user = Auth::id();
        $value = $request->search_value;
        $cart = Cart::with('product')->where('id', $this->getCartId())
            ->when($user, function ($query, $user) {
                $query->where('user_id', $user)->orWhereNull('user_id');
            })
            ->get();
        $item_count = $cart->count();

        /** if i want to bring a relation in another relation With('user.store,gallery') */
        $categories = Category::all();
        $top_sales = Product::/*withoutGlobalScope('ordered')->*/ TopSales(10);
        //$expensive_sales=Product::highPrice(120,500)->get();
        $products = Product::with('category.subcategories', 'product_images', 'user')->search($value)
            ->orderByDesc('updated_at')->paginate(10);

        if (count($products) > 0) {
            return view('store.search', compact('products', 'categories', 'top_sales', 'cart', 'item_count'));
        } else {
            return view('store.search', compact('products', 'categories', 'top_sales', 'cart', 'item_count'));
            toast('NO RESULT !', 'error');
        }
    }

    public function about()
    {
        $user = Auth::id();
        $cart = Cart::with('product')->where('id', $this->getCartId())
            ->when($user, function ($query, $user) {
                $query->where('user_id', $user)->orWhereNull('user_id');
            })
            ->get();
        $item_count = $cart->count();
        $about = About::with('user')->first();

        return view('store.about', compact('cart', 'item_count','about'));
    }

    public function contact()
    {
        $user = Auth::id();
        $cart = Cart::with('product')->where('id', $this->getCartId())
            ->when($user, function ($query, $user) {
                $query->where('user_id', $user)->orWhereNull('user_id');
            })
            ->get();
        $item_count = $cart->count();
        return view('store.contact', compact('cart', 'item_count'));
    }

    public function shop()
    {
        $user = Auth::id();
        $cart = Cart::with('product')->where('id', $this->getCartId())
            ->when($user, function ($query, $user) {
                $query->where('user_id', $user)->orWhereNull('user_id');
            })
            ->get();
        $item_count = $cart->count();
        return view('store.products', compact('cart', 'item_count'));
    }
}
