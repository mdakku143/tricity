<?php

// app/Http/Middleware/Authenticate.php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class Authenticate
{
    public function handle(Request $request, Closure $next, ...$guards)
    {
        if (Auth::guard('reporter')->check() && !Auth::guard('reporter')->user()->hasVerifiedEmail()) {
            return redirect()->route('reporter.verification.notice');
        }

        return $next($request);
    }
}
