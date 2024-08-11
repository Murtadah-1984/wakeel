<?php

namespace App\Services\Notification;

use App\Contracts\NotificationChannelInterface;
use GuzzleHttp\Client;

class TelegramService implements NotificationChannelInterface
{
    protected $client;
    protected $apiToken;
    protected $chatId;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiToken = env('TELEGRAM_API_TOKEN');
        $this->chatId = env('TELEGRAM_CHAT_ID');
    }

    public function send($to, $message)
    {
        $response = $this->client->post("https://api.telegram.org/bot{$this->apiToken}/sendMessage", [
            'form_params' => [
                'chat_id' => $this->chatId,
                'text' => $message,
            ],
        ]);

        return json_decode((string) $response->getBody(), true);
    }
}
