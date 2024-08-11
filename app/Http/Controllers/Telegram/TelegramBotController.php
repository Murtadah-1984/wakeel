<?php

namespace App\Http\Controllers\Telegram;

use Illuminate\Http\Request;
use App\Services\Telegram\TelegramBotApiService;
use App\Http\Controllers\Controller;

/**
 * TelegramBotController
 *
 * Handles all available methods in TelegramBotApiService.
 */
class TelegramBotController extends Controller
{
    protected $botService;

    /**
     * Constructor to initialize TelegramBotApiService.
     *
     * @param TelegramBotApiService $botService
     */
    public function __construct(TelegramBotApiService $botService)
    {
        $this->botService = $botService;
    }

    /**
     * Send a message via the Telegram Bot API.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendMessage(Request $request)
    {
        $request->validate([
            'chat_id' => 'required|string',
            'message' => 'required|string',
        ]);

        $chatId = $request->input('chat_id');
        $message = $request->input('message');

        try {
            $this->botService->sendMessage($chatId, $message);
            return redirect()->back()->with('success', 'Message sent successfully via Bot API!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to send message via Bot API: ' . $e->getMessage());
        }
    }

    // Example Method for sending a photo
    public function sendPhoto(Request $request)
    {
        $request->validate([
            'chat_id' => 'required|string',
            'photo' => 'required|file|image|max:10240', // Max 10MB
            'caption' => 'nullable|string',
        ]);
    
        $chatId = $request->input('chat_id');
        $photo = $request->file('photo');
        $caption = $request->input('caption');
    
        try {
            $this->botService->sendPhoto($chatId, $photo->path(), $caption);
            return redirect()->back()->with('success', 'Photo sent successfully via Bot API!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to send photo via Bot API: ' . $e->getMessage());
        }
    }
    
    // Example Method for uploading a file
    public function uploadFile(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:20480', // Max 20MB
        ]);
    
        $file = $request->file('file');
    
        try {
            $fileId = $this->apiService->uploadFile($file->path());
            return redirect()->back()->with('success', 'File uploaded successfully! File ID: ' . $fileId);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to upload file: ' . $e->getMessage());
        }
    }


}
