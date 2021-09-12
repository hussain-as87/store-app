<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Store;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;
use App\Models\Admin\Product;
use App\Models\Admin\Category;
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
            $item_count=$cart->count();

        /** if i want to bring a relation in another relation With('user.store,gallery') */
        $categories = Category::all();
        $top_sales = Product::/*withoutGlobalScope('ordered')->*/TopSales(10);
        //$expensive_sales=Product::highPrice(120,500)->get();
        $products = Product::with('category.subcategories', 'product_images', 'user')->orderByDesc('updated_at')->paginate(10);
        return view('store.home', compact('product', 'products', 'categories', 'top_sales', 'cart','item_count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function productShow(Product $product)
    {$user = Auth::id();
        $cart = Cart::with('product')->where('id', $this->getCartId())
            ->when($user, function ($query, $user) {
                $query->where('user_id', $user)->orWhereNull('user_id');
            })
            ->get();
            $item_count=$cart->count();
        return view('store.product_show', compact('product', 'cart','item_count'));
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
}
