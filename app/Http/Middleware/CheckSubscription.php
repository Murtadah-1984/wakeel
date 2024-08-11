<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckSubscription
{
    public function handle($request, Closure $next)
    {
        $tenant = Auth::user();

        if (!$tenant->subscription || !$tenant->subscription->is_active) {
            return redirect()->route('subscription.plans');
        }

        return $next($request);
    }
}

