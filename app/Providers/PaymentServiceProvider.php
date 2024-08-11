<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\PaymentGatewayInterface;
use App\Services\FIBService;
use App\Services\FastPayService;
use App\Services\ZainCashService;
use App\Services\AreebaService;
use App\Services\PayPalService;
use App\Services\StripeService;

class PaymentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PaymentGatewayInterface::class, function ($app) {
            $gateway = request()->input('gateway', config('payment.gateway')); // 'fib', 'fastpay', 'zaincash', 'areeba', 'paypal', 'stripe', etc.

            switch ($gateway) {
                case 'fib':
                    return new FIBService();
                case 'fastpay':
                    return new FastPayService();
                case 'zaincash':
                    return new ZainCashService();
                case 'areeba':
                    return new AreebaService();
                case 'paypal':
                    return new PayPalService();
                case 'stripe':
                    return new StripeService();
                default:
                    throw new \Exception("Unsupported payment gateway: {$gateway}");
            }
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
