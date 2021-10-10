<?php

namespace App\Providers;

use App\Models\User;
/* use Laravel\Passport\Passport;
 */use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        /*   Gate::before(function ($user, $ability) {
            if ($user->type == 'super_admin') {
                return true;
            }
        }); */
        /*  foreach (config('permission.category') as $name => $label) { */
        /*    Gate::define($name, function (User $user/*,$model*//* ) use ($name) {  */
        /* if ($model->user_id != $user->id) {
                    return Response::deny('you not owner of the product !');
                }*/
        /*    return $user->hasPermission($name);
            });
        } */
       /*  if (!$this->app->routesAreCached()) {
            Passport::routes();
        } */
    }
}
