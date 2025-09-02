<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ShareAuthWithApi
{
    public function handle(Request $request, Closure $next)
    {
        if (session()->has('user_id')) {
            auth()->loginUsingId(session('user_id'));
        }
        
        return $next($request);
    }
}
