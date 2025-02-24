<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;

class CheckSuperAdmin
{
    public function handle($request, Closure $next)
    {
        return $next($request);
    }
}
