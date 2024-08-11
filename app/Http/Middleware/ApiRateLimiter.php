<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Cache\RateLimiter;
use Closure;

class ApiRateLimiter
{
    protected $limiter;

    public function __construct(RateLimiter $limiter)
    {
        $this->limiter = $limiter;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $apiName
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $apiName = 'default')
    {
        $key = $this->resolveRequestRateLimiterKey($request, $apiName);
        $maxAttempts = config("api_limits.{$apiName}.max_attempts", 60); // default to 60
        $decayMinutes = config("api_limits.{$apiName}.decay_minutes", 1); // default to 1 minute

        if ($this->limiter->tooManyAttempts($key, $maxAttempts)) {
            return response()->json([
                'message' => 'Too Many Requests',
            ], 429);
        }

        $this->limiter->hit($key, $decayMinutes * 60);

        return $next($request);
    }

    protected function resolveRequestRateLimiterKey(Request $request, $apiName)
    {
        return sha1($apiName . '|' . $request->ip());
    }
}
