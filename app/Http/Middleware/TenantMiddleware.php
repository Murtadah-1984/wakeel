<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tenant;
use Symfony\Component\HttpFoundation\Response;

class TenantMiddleware
{
     public function handle($request, Closure $next)
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        $user = Auth::user();
        
        
        
        $domain = $user->tenants->first()->domain;
        

        if (!$domain) {
            // Handle case where tenant is not found
            abort(404, 'Tenant not found');
        }

        // Store the tenant information in the request
        $request->merge(['domain' => $domain]);

        return $next($request);
    }
}
