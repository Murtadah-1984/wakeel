<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;


class DashboardServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Bind the subscription object as a singleton
        $this->app->singleton('subscription', function ($app) {
            $user = Auth::user();

            return $user ? $user->currentSubscription() : null;
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
