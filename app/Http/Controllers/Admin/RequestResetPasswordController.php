<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Notifications\ResetPasswordCodeNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;

class RequestResetPasswordController extends Controller
{
    public function index()
    {
        return view('admin.password-reset.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'mobile' => 'required|exists:users,mobile'
        ]);
        $mobile = $request->post('mobile');
        $mobile = ltrim($mobile, '+970');
        $user = User::where('mobile', $mobile)->first();
        $code = Str::random(8);
        DB::table('password_resets')->where('email', $mobile)->delete();
        DB::table('password_resets')->insert([
            'email' => $mobile,
            'token' => $code,
            'created_at' => Carbon::now()
        ]);

        // $user->notify(new ResetPasswordCodeNotification($mobile));
        return redirect()->route('request.password.code', $mobile);
    }

    public function code()
    {
        $mobile = request('mobile');
        return view('admin.password-reset.code', compact('mobile'));
    }

    public function check(Request $request)
    {
        $request->validate([
            'mobile' => 'required',
            'code' => 'required',
        ]);
        $mobile = ltrim($request->post('mobile'), '+970');
        $reset = DB::table('password_resets')->where('email', $mobile)
            ->where('token', $request->code)
            ->first();
        if (!$reset) {
            toast(__('passwords not reset'), 'error');
            return redirect()->back()->withInput()->withErrors(['code' => __('Invalid Mobile Code')]);
        }
        $user = DB::table('password_resets')->where('email', $mobile)->first();
        if (!$user) {
            toast(__('passwords not reset'), 'error');
            return redirect()->back()->withInput()->withErrors(['code' => __('Invalid Mobile Number')]);
        }
        toast(__('passwords.reset'), 'success');
        //$reset->delete();
        $route = URL::temporarySignedRoute('request.password.reset', Carbon::now()->addMinutes(20), [
            'user' => $user->id,
        ]);
        dd($route);
        return redirect()->to($route);
    }


    public function reset(Request $request, User $user)
    {
        if ($request->hasValidSignature()) {
            abort(404);
        }
        if (strtoupper($request->method()) == 'POST') {
            $request->validate([
                'password' => 'required|confirmed',
                'password_confirmation' => 'required',
            ]);

            $user->forceFill([
                'password' => Hash::make($request->post('password'))
            ])->save();
            return redirect()->route('login');
        }
        return view('admin.password-reset.reset', compact('user'));
    }
}
