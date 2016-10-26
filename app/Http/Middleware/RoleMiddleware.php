<?php

namespace StorAvell\Http\Middleware;

use Auth;
use Closure;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role, $permission)
    {
        if (Auth::guest()) {
//            die(var_dump($request->is('admin/*')));
            if ($request->is('admin') || $request->is('admin/*')) {
                return redirect(config("laravel-permission.adminLoginPath"));
            }
            return redirect(config('laravel-permission.frontEndLoginPath'));
        }

        if (! $request->user()->hasRole($role)) {
            abort(403);
        }

        if (! $request->user()->can($permission)) {
            abort(403);
        }

        return $next($request);
    }
}
