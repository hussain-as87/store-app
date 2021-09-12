<?php

namespace App\Http\Controllers;

use App\Models\Admin\Product;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::id();
        $cart = Cart::with('product')->where('id', $this->getCartId())
            ->when($user, function ($query, $user) {
                $query->where('user_id', $user)->orWhereNull('user_id');
            })
            ->get();
        return view('cart.index', compact('cart'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required | exists:products,id',
            'quantity' => 'int|min:1'
        ]);
        /*if he have price*/
        $product = Product::findOrFail($request->post('product_id'));
        $quantity = $request->post('quantity', 1);

        /*       if ($cart) {
                    $cart->increment('quantity', $request->post('quantity', 1));*/
        /**updated quantity plus number for */
        /*} else {
            Cart::create([
                'id'=>$this->getCartId(),
                'user_id' => auth()->id(),
                'product_id' => $product->id,
                'price' => $product->price,
                'quantity' => $request->post('quantity', 1)]);
        }*/
        Cart::updateOrCreate(
            [
                'id' => $this->getCartId(),
                'product_id' => $product->id
            ],
            [
                'user_id' => auth()->id(),
                'price' => $product->price,
                'quantity' => DB::raw("quantity + $quantity")
            ]
        );

        toast('the product ' . $product->name . ' added', 'success');
        return redirect()->route('cart.index');
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
        Cart::where('product_id',$id)->delete();
        return redirect()->back();
    }

    public function checkout()
    {
        $cart = Cart::with('product')->where('user_id', auth()->id())->get();
        return view('cart.checkout', compact('cart'));
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
