<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order = Order::with('products')->where('user_id', auth()->id())->get();
        return $order/*view('order.index',compact('order'))*/ ;
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

    public function checkout()
    {
        $order = Order::create([
            'user_id' => 3,
            'total' => 500.5
        ]);
        //3D
        session()->put('pay_order_id', $order->id);
        return view('payment.moyasar', compact('order'));
    }


    public function callback()
    {
        $id = request()->query('id');
        //curl
        $payment = Http::baseUrl('https://api.moyasar.com/v1/')
            ->withBasicAuth(config('services.moyasar.key'), '')
            ->get('payments/{$id}')
            ->json();


        $order_id = session()->get('pay_order_id');
        session()->forget('pay_order_id');
        $order = Order::findOrFail($order_id);
        $capture = Http::baseUrl('https://api.moyasar.com/v1/')
            ->withBasicAuth(config('services.moyasar.key'), '')
            ->get('payments/{$id}/capture')
            ->json();


        if ($capture) {
            $order->update([
                'status' => 'completed'
            ]);
        }
    }
}
