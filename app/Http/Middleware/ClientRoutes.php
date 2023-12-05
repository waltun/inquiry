<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ClientRoutes
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->user()->role == 'client' || $request->user()->role == 'admin') {
            return $next($request);
        }

        abort(403);
    }
}
