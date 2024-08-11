<?php

namespace App\Services;

use Vonage\Client;
use Vonage\Client\Credentials\Basic;
use Vonage\SMS\Message\SMS;

class VonageService
{
    protected $client;

    public function __construct()
    {
        $basic  = new Basic(config('services.vonage.key'), config('services.vonage.secret'));
        $this->client = new Client($basic);
    }

    /**
     * Send an SMS to a mobile number.
     *
     * @param string $to The recipient's mobile number.
     * @param string $message The message to send.
     * @return array The response from the Vonage API.
     */
    public function sendSms(string $to, string $message)
    {
        try {
            $response = $this->client->sms()->send(
                new SMS($to, config('services.vonage.from'), $message)
            );
            
            $message = $response->current();
            
            if ($message->getStatus() == 0) {
                return ['success' => true, 'message' => 'Message sent successfully'];
            } else {
                return ['success' => false, 'message' => 'Message failed with status: ' . $message->getStatus()];
            }
        } catch (\Exception $e) {
            return ['success' => false, 'message' => 'Message failed with error: ' . $e->getMessage()];
        }
    }
}
