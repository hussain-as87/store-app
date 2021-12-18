<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Support\Str;
use App\Models\Admin\Coupon;
use Illuminate\Http\Request;

class CouponController extends BaseController
{
    public function index()
    {
        $coupon = Coupon::orderByDesc('updated_at', 'desc')->paginate(20);
        return view('admin.coupon_code.index', compact('coupon'));
    }

    public function create()
    {
        $coupon = Coupon::all();
        return view('admin.coupon_code.create', compact('coupon'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'discount_value' => 'required',
            'is_active' => 'required|max:1|min:1'
        ]);
        $coupon = Coupon::create([
            'code' => Str::random(8),
            'discount_value' => '0.' . $request->discount_value,
            'is_active' => $request->is_active
        ]);
        if ($coupon) {
            toast('Successfully', 'success');
            return redirect()->back();
        } else {
            toast('Error!!', 'error');
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        $coupon = Coupon::findOrFail($id)->delete();
        if ($coupon) {
            toast('Deleted !!', 'error');
            return redirect()->back();
        }
    }

    public function coupon_check()
    {
        $coupon = Coupon::where('code', request()->post('code'))->first();

        if (isset($coupon) || !empty($coupon)) {
            toast('Successfully !!!', 'success');
            return redirect()->back()->with('coupon');
        } else {
            toast('Not Found !!!', 'error');
            return redirect()->back();
        }
    }
}
