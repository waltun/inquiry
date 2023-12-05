<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class NormalRoutes
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->user()->role != 'client') {
            return $next($request);
        }

        abort(403);
    }
}
