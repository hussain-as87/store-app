<?php

namespace App\Http\Controllers;

use App\Models\Admin\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Laravel\Socialite\Facades\Socialite;
use Throwable;

class SocialLoginController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }


    public function callback($provider)
    {

        $user = Socialite::driver($provider)->user();

        $authUser = $this->findOrCreateUser($user);

        Auth::login($authUser, true);

        return Redirect::to(route('store.home'));
    }


    private function findOrCreateUser($proiderUser)
    {
        if ($authUser = User::where('provider_id', $proiderUser->id)->first()) {
            return $authUser;
        }

        return User::create([
            'name' => $proiderUser->name,
            'email' => $proiderUser->email,
            'provider_id' => $proiderUser->id,
        ]);
        Profile::create([
            'user_id' => $proiderUser->id,
            'avatar' => $proiderUser->avatar
        ]);
    }
}
