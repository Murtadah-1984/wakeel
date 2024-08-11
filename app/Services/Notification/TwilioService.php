<?php

namespace App\Services\Notification;

use Twilio\Rest\Client;
use App\Contracts\NotificationChannelInterface;

class TwilioService implements NotificationChannelInterface
{
    protected $twilio;

    public function __construct()
    {
        $this->twilio = new Client(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN'));
    }

    public function sendWhatsAppMessage($to, $message)
    {
        return $this->twilio->messages->create(
            "whatsapp:$to",
            [
                'from' => env('TWILIO_WHATSAPP_FROM'),
                'body' => $message
            ]
        );
    }

    public function sendSMS($to, $message)
    {
        return $this->twilio->messages->create(
            $to,
            [
                'from' => env('TWILIO_PHONE_NUMBER'),
                'body' => $message
            ]
        );
    }

    public function send($to, $message)
    {
        // Decide based on the format of the $to parameter whether to send SMS or WhatsApp
        if (strpos($to, 'whatsapp:') !== false) {
            return $this->sendWhatsAppMessage(str_replace('whatsapp:', '', $to), $message);
        } else {
            return $this->sendSMS($to, $message);
        }
    }
}
