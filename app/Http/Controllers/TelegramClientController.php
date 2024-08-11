<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Telegram\Bot\Api;

class TelegramClientController extends Controller
{
    protected $telegram;

    public function __construct()
    {
        $this->telegram = new Api(config('services.telegram.bot_token'));
    }

    public function webhook(Request $request)
    {
        $update = $this->telegram->getWebhookUpdates();
        // Process the update here

        return response()->json(['status' => 'success']);
    }

    public function getUpdates()
    {
        $updates = $this->telegram->getUpdates();
        return response()->json($updates);
    }

    public function sendMessage(Request $request)
    {
        $params = [
            'chat_id' => $request->input('chat_id'),
            'text' => $request->input('text')
        ];

        $this->telegram->sendMessage($params);

        return response()->json(['status' => 'Message sent successfully']);
    }
}
