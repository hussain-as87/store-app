<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Notifications\ResetPasswordCodeNotification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function showForgetPasswordForm()
    {
        return view('admin.password-reset.index');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function submitForgetPasswordForm(Request $request)
    {
        $request->validate([
            'mobile' => 'required|exists:users,mobile',
        ]);

        $token = Str::random(8);

        DB::table('password_resets')->insert([
            'email' => $request->post('mobile'),
            'token' => $token,
            'created_at' => Carbon::now()
        ]);
        $user = User::where('mobile', $request->post('mobile'))->first();

        $user->notify(new ResetPasswordCodeNotification($request->post('mobile')));

        toast(__('We have e-mailed your password reset link!'), 'success');
        return redirect()->route('reset.password.token');
    }
    public function token_code()
    {
        return view('admin.password-reset.code');
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function showResetPasswordForm(Request $request)
    {
        $reset = DB::table('password_resets')->where('token', $request->post('token'))->first();
        if (!$reset) {
            toast('token is not wright!', 'error');
            return redirect()->back();
        }
        return view('admin.password-reset.reset', ['token' => $reset->token]);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function submitResetPasswordForm(Request $request)
    {
        $request->validate([
            'mobile' => 'required|exists:users,mobile',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);

        $updatePassword = DB::table('password_resets')
            ->where([
                'email' => $request->post('mobile'),
                'token' => $request->token
            ])
            ->first();

        if (!$updatePassword) {
            return back()->withInput()->with('error', 'Invalid token!');
        }

        $user = User::where('mobile', $request->post('mobile'))
            ->update(['password' => Hash::make($request->password)]);

        DB::table('password_resets')->where(['email' => $request->post('mobile')])->delete();

        return redirect('/login')->with('message', 'Your password has been changed!');
    }
}
