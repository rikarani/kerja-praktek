<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, string $role)
    {
        abort_if(! Auth::check() || Auth::user()->role->slug !== $role, 403, 'Unauthorized');

        return $next($request);
    }
}
