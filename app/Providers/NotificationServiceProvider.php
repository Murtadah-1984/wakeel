<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\NotificationChannelInterface;
use App\Services\TwilioService;
use App\Services\EmailService;
use App\Services\TelegramService;

class NotificationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(NotificationChannelInterface::class, function ($app) {
            $channel = request()->input('channel', 'email'); // 'email', 'sms', 'whatsapp', 'telegram', etc.

            switch ($channel) {
                case 'sms':
                case 'whatsapp':
                    return new TwilioService();
                case 'email':
                    return new EmailService();
                case 'telegram':
                    return new TelegramService();
                default:
                    throw new \Exception("Unsupported notification channel: {$channel}");
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
