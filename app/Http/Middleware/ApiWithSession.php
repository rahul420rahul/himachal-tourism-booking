<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApiWithSession
{
    public function handle(Request $request, Closure $next)
    {
        // Start session for API routes
        if (!$request->hasSession()) {
            $request->setLaravelSession(app('session.store'));
        }
        
        return $next($request);
    }
}
