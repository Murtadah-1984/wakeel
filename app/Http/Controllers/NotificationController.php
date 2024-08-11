<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\NotificationChannelInterface;

class NotificationController extends Controller
{
    protected $notificationService;

    public function __construct(NotificationChannelInterface $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    public function sendNotification(Request $request)
    {
        $data = $request->validate([
            'channel' => 'required|string', // 'email', 'sms', 'whatsapp', 'telegram'
            'to' => 'required|string',
            'message' => 'required|string',
        ]);

        $response = $this->notificationService->send($data['to'], $data['message']);

        return response()->json($response);
    }
}
