<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Cache\RateLimiter;

class ApiLimitController extends Controller
{
    protected $limiter;

    public function __construct(RateLimiter $limiter)
    {
        $this->limiter = $limiter;
    }
    /**
     * Display the current API limits.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $apiLimits = config('api_limits');
        return view('rate-limit', compact('apiLimits'));
    }

    /**
     * Add or update API rate limit.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        $request->validate([
            'api_name' => 'required|string',
            'max_attempts' => 'required|integer|min:1',
            'decay_minutes' => 'required|integer|min:1',
        ]);
    
        $apiName = $request->input('api_name');
        $maxAttempts = $request->input('max_attempts');
        $decayMinutes = $request->input('decay_minutes');
    
        // Load the existing api_limits.php configuration
        $configPath = config_path('api_limits.php');
        $config = File::getRequire($configPath);
    
        // Add or update the rate limit for the API
        $config[$apiName] = [
            'max_attempts' => $maxAttempts,
            'decay_minutes' => $decayMinutes,
        ];
    
        // Write the updated configuration back to the file
        $configContent = '<?php return ' . var_export($config, true) . ';' . PHP_EOL;
        File::put($configPath, $configContent);
    
        return redirect()->route('api-limits.show')->with('success', 'API rate limit updated successfully.');
    }
    
    public function monitor()
    {
        // Load the existing api_limits.php configuration
        $apiLimits = config('api_limits');
    
        // Prepare data for Chart.js
        $labels = [];
        $maxAttemptsData = [];
        $decayMinutesData = [];
    
        foreach ($apiLimits as $apiName => $limit) {
            $labels[] = $apiName;
            $maxAttemptsData[] = $limit['max_attempts'];
            $decayMinutesData[] = $limit['decay_minutes'];
        }
    
        // Returning data for Chart.js
        return response()->json([
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Max Attempts',
                    'backgroundColor' => 'rgba(75, 192, 192, 0.2)',
                    'borderColor' => 'rgba(75, 192, 192, 1)',
                    'borderWidth' => 1,
                    'data' => $maxAttemptsData,
                ],
                [
                    'label' => 'Decay Minutes',
                    'backgroundColor' => 'rgba(255, 159, 64, 0.2)',
                    'borderColor' => 'rgba(255, 159, 64, 1)',
                    'borderWidth' => 1,
                    'data' => $decayMinutesData,
                ],
            ],
        ]);
    }
    
    protected function resolveRequestRateLimiterKey(Request $request, $apiName)
    {
        return sha1($apiName . '|' . $request->ip());
    }

    
     /**
     * Check if the rate limit is exceeded and log if it is.
     *
     * @param  string  $key
     * @param  int     $maxAttempts
     * @param  string  $apiName
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse|null
     */
    public function checkRateLimitExceeded($key, $maxAttempts, $apiName, Request $request)
    {
        if ($this->limiter->tooManyAttempts($key, $maxAttempts)) {
            Log::warning("Rate limit exceeded for API: {$apiName} by IP: {$request->ip()}");

            return response()->json(['error' => 'Too Many Requests'], 429);
        }

        return null;
    }
    
    /**
     * Get statistics about current rate limits for all APIs.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getRateLimitStats()
    {
        // Load the existing api_limits.php configuration
        $apiLimits = config('api_limits');

        // Prepare data for Chart.js
        $labels = [];
        $maxAttemptsData = [];
        $currentAttemptsData = [];
        $remainingAttemptsData = [];

        foreach ($apiLimits as $apiName => $limit) {
            $labels[] = $apiName;
            $maxAttempts = $limit['max_attempts'];
            $key = sha1($apiName); // Assuming rate limiter key is sha1 of API name
            $currentAttempts = Cache::get($key, 0); // Get current attempts from cache

            $maxAttemptsData[] = $maxAttempts;
            $currentAttemptsData[] = $currentAttempts;
            $remainingAttemptsData[] = max(0, $maxAttempts - $currentAttempts);
        }

        // Returning data for Chart.js
        return response()->json([
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Max Attempts',
                    'backgroundColor' => 'rgba(75, 192, 192, 0.2)',
                    'borderColor' => 'rgba(75, 192, 192, 1)',
                    'borderWidth' => 1,
                    'data' => $maxAttemptsData,
                ],
                [
                    'label' => 'Current Attempts',
                    'backgroundColor' => 'rgba(255, 99, 132, 0.2)',
                    'borderColor' => 'rgba(255, 99, 132, 1)',
                    'borderWidth' => 1,
                    'data' => $currentAttemptsData,
                ],
                [
                    'label' => 'Remaining Attempts',
                    'backgroundColor' => 'rgba(54, 162, 235, 0.2)',
                    'borderColor' => 'rgba(54, 162, 235, 1)',
                    'borderWidth' => 1,
                    'data' => $remainingAttemptsData,
                ],
            ],
        ]);
    }

}

