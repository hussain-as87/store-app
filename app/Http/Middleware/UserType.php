<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserType
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$type)
    {
        $user = Auth::user();
        if (!in_array($user->type, $type)) {
            toast('You are not ' . implode(' or ', $type) . ' !!!', 'warring');
            return redirect('/');
        }
        return $next($request);
        /**(return $next($request)) to continue to work another middleware*/
    }
}
