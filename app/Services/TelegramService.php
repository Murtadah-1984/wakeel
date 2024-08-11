<?php

namespace App\Services;

use Telegram\Bot\Api;

class TelegramService
{
    protected $telegram;
    protected $appId;
    protected $appHash;

    public function __construct()
    {
        $this->telegram = new Api(config('services.telegram.bot_token'));
        $this->appId = config('services.telegram.app_id');
        $this->appHash = config('services.telegram.app_hash');
    }

    public function authenticate($authData)
    {
        // Validate the auth data received from Telegram
        if ($this->validateTelegramAuth($authData)) {
            // Auth data is valid, proceed with user authentication
            return $authData['id']; // Example: return user ID
        }
        
        return false;
    }

    private function validateTelegramAuth($authData)
    {
        // Implement Telegram auth data validation
        // Reference: https://core.telegram.org/widgets/login#checking-authorization
        $checkHash = $authData['hash'];
        unset($authData['hash']);

        $dataCheckArr = [];
        foreach ($authData as $key => $value) {
            $dataCheckArr[] = $key . '=' . $value;
        }
        sort($dataCheckArr);
        $dataCheckString = implode("\n", $dataCheckArr);

        $secretKey = hash('sha256', $this->appId . $this->appHash, true);
        $hash = hash_hmac('sha256', $dataCheckString, $secretKey);

        return $hash === $checkHash;
    }

    public function sendMessage($chatId, $message)
    {
        try {
            $response = $this->telegram->sendMessage([
                'chat_id' => $chatId,
                'text' => $message,
            ]);

            return $response;
        } catch (\Exception $e) {
            // Handle exception
            return $e->getMessage();
        }
    }
}
