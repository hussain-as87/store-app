<?php

namespace App\Providers;

/* use Laravel\Passport\Passport;
 */

use Illuminate\Support\Facades\App;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /*         Passport::hashClientSecrets();
                Passport::tokensExpireIn(now()->addDays(15));
                Passport::refreshTokensExpireIn(now()->addDays(30));
                Passport::personalAccessTokensExpireIn(now()->addMonths(6));

         */
        $locale = config('locales.fallback_locale');
        App::setLocale($locale);
        Lang::setLocale($locale);
        Session::put('locale', $locale);
        Schema::defaultStringLength(125);
        Paginator::useBootstrap();
    }
}
