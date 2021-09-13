<?php

namespace App\Http\Livewire;

use App\Models\Admin\Coupon;
use App\Models\Cart;
use App\Models\Order;
use Ramsey\Uuid\Uuid;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class Counter extends Component
{

    public $quantity = 0;
    public $cart = [];
    protected $listeners = ['cartUpdated' => 'onCartUpdate'];
    public function plus($id)
    {
        $this->quantity++;
        DB::update('update carts set quantity = quantity+1 where product_id = ?', [$id]);
    }
    public function minus($id)
    {
        $this->quantity--;
        DB::update('update carts set quantity = quantity-1 where product_id = ?', [$id]);
    }
    public function mount()
    {
        $this->cart
            = Cart::with('product')->where('id', $this->getCartId())
            ->when(auth()->id(), function ($query, $user) {
                $query->where('user_id', $user)->orWhereNull('user_id');
            })
            ->get();
    }
    public function onCartUpdate()
    {

        // $this->cartItems = \Cart::session(auth()->id())->getContent()->toArray();
        $this->mount();
    }
    public function render(Request $request)
    {
        $user = Auth::id();
        $cart = Cart::with('product')->where('id', $this->getCartId())
            ->when($user, function ($query, $user) {
                $query->where('user_id', $user)->orWhereNull('user_id');
            })
            ->get();

        return view('livewire.counter', compact('cart'));
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
    public function destroy($id)
    {
        Cart::where('product_id', $id)->delete();
        return redirect()->back();
    }

    public function coupon_index(Request $request)
    {
        $coupon=Coupon::where('code',$request->code_cupon)->first();
        return redirect()->back();

    }
}
