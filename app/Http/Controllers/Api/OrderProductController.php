<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\OrderProduct;

class OrderProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        auth()->user()->currentAccessToken()->tokenable->id;
        $orders = DB::table('order_products')->paginate(10);
        if ($orders) {
            return new JsonResponse([
                'status' => '201',
                'data' => $orders
            ]);
        } else {
            return new JsonResponse([
                'status' => '404',
                'message' => 'empty!'
            ]);
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
        auth()->user()->currentAccessToken()->tokenable->id;
        $request->validate([
            'product_id' => 'required',
            'order_id' => 'required',
            'price' => 'required',
            'quantity' => 'required',
        ]);
        $order = OrderProduct::create([
            'product_id' => $request->product_id,
            'order_id' => $request->order_id,
            'price' => $request->price,
            'quantity' => $request->quantity,
        ]);
        if ($order) {
            return new JsonResponse([
                'status' => '201',
                'data' => $order->id . 'created',
            ]);
        } else {
            return new JsonResponse([
                'status' => '500',
                'message' => 'error!',
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
            'product_id' => 'required',
            'order_id' => 'required'
        ]);
        $order = OrderProduct::where([
            'order_id' => $request->order_id,
            'product_id' => $request->product_id
        ])->first();

        if ($order) {
            $order->delete();
            return new JsonResponse([
                'status' => '201',
                'message' => 'the order product is deleted successfully !'
            ]);
        } else {
            return new JsonResponse([
                'status' => '404',
                'message' => 'Not Found !'
            ]);
        }
    }
}
