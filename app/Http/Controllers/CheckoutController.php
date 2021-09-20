<?php

namespace App\Http\Controllers;

use App\Events\OrderCompleted;
use App\Events\OrderCreate;
use App\Models\Cart;
use App\Models\Order;
use App\Notifications\OrderCreatedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;

class CheckoutController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cart = Cart::with('product')->where('user_id', auth()->id())->get();
        return view('cart.checkout', compact('cart'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = $request->user();
        DB::beginTransaction();
        try {
            $order = $user->orders()->create([]);
            $cart = Cart::where('user_id', auth()->id())->get();
            $total = 0;
            foreach ($cart as $item) {
                $order->orderProduct()->create([
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                ]);
                /* OrderProduct::create([
                     'order_id' => $order->id,
                     'product_id' => $item->product_id,
                     'quantity' => $item->quantity,
                     'price' => $item->price,
                 ]);*/
                $total += $item->price * $item->quantity;
            }
            Order::where('user_id',auth()->id())->delete();
            $user->carts()->delete();

            Cookie::queue(Cookie::make('cart_id', '', -60));
            // Cart::where('user_id', auth()->id())->delete();
            DB::commit();
            toast(__('done !'), 'success');
            event(new OrderCreate($order));
            /** trigger for event orderCreated*/
            return $this->paypal($order, $total);
            //return redirect()->route('order.index');
        } catch (\Throwable $exception) {
            DB::rollBack();
            throw $exception;
        }
    }



    protected function paypal(Order $order, $total)
    {
        $clint = $this->paypalClint();
        $request = new OrdersCreateRequest();
        $request->prefer('return=representation');
        $request->body = [
            "intent" => "CAPTURE",
            "purchase_units" => [[
                "reference_id" => $order->id,
                "amount" => [
                    "value" => $total,
                    "currency_code" => "USD"
                ]
            ]],
            "application_context" => [
                "cancel_url" => url(route('paypal.cancel')),
                "return_url" => url(route('paypal.return'))
            ]
        ];
        try {
            $response = $clint->execute($request);
            if ($response->statusCode == 201) {
                session()->put('paypal_order_id', $response->result->id);
                session()->put('order_id', $order->id);
                foreach ($response->result->links as $link) {
                    if ($link->rel == 'approve') {
                        return redirect()->away($link->href);
                    }
                }
            }
        } catch (\Throwable $exception) {
            return $exception->getMessage();
        }
        return __('unknown Error !' . $response->statusCode);
    }

    protected function paypalClint()
    {
        $config = config('services.paypal');
        $env = new SandboxEnvironment($config['clint_id'], $config['clint_secret']);
        $clint = new PayPalHttpClient($env);
        return $clint;
    }

    public function paypalReturn()
    {
        $paypal_order_id = session()->get('paypal_order_id');
        $request = new OrdersCaptureRequest($paypal_order_id);
        $request->prefer('return=representation');
        try {
            $response = $this->paypalClint()->execute($request);
            if ($response->statusCode == 201) {
                if (strtoupper($response->result->status) == 'COMPLETED') {
                    $id = session()->get('order_id');
                    $order = Order::findOrFail($id);
                    $order->status = 'completed';
                    $order->save();
                    session()->forget(['order_id', 'paypal_order_id']);
                    event(new OrderCompleted());
                    return redirect()->route('orders');
                }
            }
        } catch (\Throwable $exception) {
            return $exception->getMessage();
        }




        /*  public function payments(Request $request,Order $order)
    {

        $paypal_payments = new paypal;
        $response = $paypal_payments->CreatePayment(int $amount, $tax, $shipping, $handling_fee, $description);

        // You will need the order_id to reference the transaction hence save it from here.
        $payment_id = $response["order_id"];

        $response = $clint->execute($request);
        if ($response->statusCode == 201) {
            session()->put('paypal_order_id', $response->result->id);
            session()->put('order_id', $order->id);
            foreach ($response->result->links as $link) {
                if ($link->rel == 'approve') {
                    return redirect()->away($link->href);
                }
            }
        }
        //the checkout link will lead the user  you to paypal  where he/she can approve the payment.
        return redirect($response["checkout_link"]);
    } */

        /*  public function paypal_redirect(Request $request)
    {
        $paypal = new Paypal;

        // This will execute the approved payment notice that the redirected url comes back with PayerID which we reuse it
        $response = $paypal->executePayment($request->paymentId, $request->PayerID);

        if (json_decode($response)->state == "approved") {
            // update your database and share the success message to the user.

        }
    } */
    }
}
