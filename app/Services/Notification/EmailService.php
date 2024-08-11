<?php

namespace App\Services\Notification;

use App\Contracts\NotificationChannelInterface;
use Illuminate\Support\Facades\Mail;

class EmailService implements NotificationChannelInterface
{
    public function send($to, $message)
    {
        Mail::raw($message, function ($msg) use ($to) {
            $msg->to($to)
                ->subject('Notification');
        });

        return ['status' => 'success', 'message' => 'Email sent'];
    }
}
