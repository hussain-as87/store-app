<?php

namespace App\Http\Controllers\Api;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        auth()->user()->currentAccessToken()->tokenable->id;
        $carts = Cart::paginate(10);
        if ($carts) {
            return new JsonResponse([
                'status' => '201',
                'data' => $carts
            ]);
        } else {
            return new JsonResponse(['status' => '404', 'message' => 'Not Found !']);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth()->user()->currentAccessToken()->tokenable->id;
        $request->validate([
            'product_id' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'id' => 'required',
        ]);
        $carts = Cart::create([
            'user_id' => $user,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'id' => $request->id,
        ]);
        if ($carts) {
            return new JsonResponse([
                'status' => '201',
                'data' => $carts
            ]);
        } else {
            return new JsonResponse([
                'status' => '500',
                'message' => 'Not Exsit !'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $user = auth()->user()->currentAccessToken()->tokenable->id;
        $request->validate([
           'product_id' => 'required'
        ]);
        $carts = Cart::where('product_id',$request->product_id)->where('user_id',$user)->first();

        if ($carts) {
            $carts->delete();
            return new JsonResponse([
                'status' => '201',
                'message' => $carts . 'deleted !'
            ]);
        } else {
            return new JsonResponse([
                'status' => '404',
                'message' => 'Not Found !'
            ]);
        }
    }
}
