<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureReporterIsVerifiedAndApproved
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $reporter = Auth::guard('reporter')->user();
        if (!$reporter || !$reporter->hasVerifiedEmail() || !$reporter->is_verified) {
            return redirect()->route('reporter.login')->with('error', 'You need to verify your email and be approved by an admin.');
        }

        return $next($request);
    }
}
