<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{

    public function handle($request, Closure $next)
    {
        if (auth('web')->check()) {
            return redirect(RouteServiceProvider::HOME);
        }

        if (auth('player')->check()) {
            return redirect(RouteServiceProvider::player);
        }

        if (auth('coach')->check()) {
            return redirect(RouteServiceProvider::coach);
        }

        if (auth('employee')->check()) {
            return redirect(RouteServiceProvider::employee);
        }

        return $next($request);
    }
}
