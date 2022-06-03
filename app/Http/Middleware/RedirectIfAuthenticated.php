<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            if ($request->is('admin') || $request->is('admin/*')) {
                return redirect()->guest(route('admin.home'));
            }else if($request->is('crm') || $request->is('crm/*')){
                return redirect()->guest(route('crm.dashboard'));
            }
            return redirect()->guest(route('home'));
        }
        return $next($request);
    }
}
