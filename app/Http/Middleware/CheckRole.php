<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle($request, Closure $next, $role)
    {
        if (!Auth::check() || !Auth::user()->roles->contains('name', $role)) {
            return redirect('/'); // Redirige si no tiene el rol requerido
        }

        return $next($request);
    }
}
