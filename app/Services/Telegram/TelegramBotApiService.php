<?php

namespace App\Services\Telegram;

use danog\MadelineProto\API;
use danog\MadelineProto\Settings\AppInfo;
use danog\MadelineProto\Settings\Connection;
use Illuminate\Support\Facades\Log;


/**
 * TelegramBotApiService
 *
 * This service handles interactions with the Telegram Bot API using MadelineProto.
 */
class TelegramBotApiService
{
    private $MadelineProto;

    /**
     * Constructor to initialize MadelineProto with Telegram API settings.
     */
    public function __construct()
    {
        // Define the settings for the MadelineProto API
        $settings = [
            'app_info' => [
                'api_id' => config('services.telegram.app_id'), // Your Telegram API ID
                'api_hash' => config('services.telegram.app_hash'), // Your Telegram API Hash
            ],
            'logger' => [
                'logger' => 0
            ],
            'connection_settings' => [
                'all' => [
                    'ipv6' => true,
                ],
                'default' => [
                    'async' => false, // Ensure synchronous connection if required
                ],
            ],
        ];

        // Initialize MadelineProto with the specified settings
        $this->MadelineProto = new API(storage_path('app/telegram_session.madeline'), $settings);

        // Start the MadelineProto API session
        $this->MadelineProto->start();
    }

    /**
     * Send a text message to a specified peer.
     *
     * @param string|int $peer The username or ID of the recipient.
     * @param string $message The message text to send.
     * @return mixed The result of the send operation.
     */
    public function sendTextMessage($peer, $message)
    {
        return $this->MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => $message]);
    }

    /**
     * Send a photo to a specified peer.
     *
     * @param string|int $peer The username or ID of the recipient.
     * @param string $photo The path to the photo file.
     * @param string $caption Optional caption for the photo.
     * @return mixed The result of the send operation.
     */
    public function sendPhoto($peer, $photo, $caption = '')
    {
        return $this->MadelineProto->messages->sendMedia([
            'peer' => $peer,
            'media' => [
                '_' => 'inputMediaUploadedPhoto',
                'file' => $photo,
                'caption' => $caption,
            ],
        ]);
    }

    /**
     * Send a video to a specified peer.
     *
     * @param string|int $peer The username or ID of the recipient.
     * @param string $video The path to the video file.
     * @param string $caption Optional caption for the video.
     * @return mixed The result of the send operation.
     */
    public function sendVideo($peer, $video, $caption = '')
    {
        return $this->MadelineProto->messages->sendMedia([
            'peer' => $peer,
            'media' => [
                '_' => 'inputMediaUploadedDocument',
                'file' => $video,
                'caption' => $caption,
            ],
        ]);
    }

    /**
     * Send an audio file to a specified peer.
     *
     * @param string|int $peer The username or ID of the recipient.
     * @param string $audio The path to the audio file.
     * @param string $caption Optional caption for the audio.
     * @return mixed The result of the send operation.
     */
    public function sendAudio($peer, $audio, $caption = '')
    {
        return $this->MadelineProto->messages->sendMedia([
            'peer' => $peer,
            'media' => [
                '_' => 'inputMediaUploadedDocument',
                'file' => $audio,
                'caption' => $caption,
            ],
        ]);
    }

    /**
     * Send a document to a specified peer.
     *
     * @param string|int $peer The username or ID of the recipient.
     * @param string $document The path to the document file.
     * @param string $caption Optional caption for the document.
     * @return mixed The result of the send operation.
     */
    public function sendDocument($peer, $document, $caption = '')
    {
        return $this->MadelineProto->messages->sendMedia([
            'peer' => $peer,
            'media' => [
                '_' => 'inputMediaUploadedDocument',
                'file' => $document,
                'caption' => $caption,
            ],
        ]);
    }

    /**
     * Receive updates using polling.
     *
     * @return array The updates received from the server.
     */
    public function receiveUpdates()
    {
        return $this->MadelineProto->getUpdates();
    }

    /**
     * Create a custom keyboard with buttons.
     *
     * @param array $buttons An array of button labels.
     * @return array The custom keyboard array.
     */
    public function createCustomKeyboard(array $buttons)
    {
        return [
            'keyboard' => [$buttons],
            'resize_keyboard' => true,
            'one_time_keyboard' => false,
        ];
    }

    /**
     * Create an inline keyboard with buttons.
     *
     * @param array $buttons An array of button labels and callback data.
     * @return array The inline keyboard array.
     */
    public function createInlineKeyboard(array $buttons)
    {
        $inlineKeyboard = [];
        foreach ($buttons as $button) {
            $inlineKeyboard[] = [
                [
                    'text' => $button['text'],
                    'callback_data' => $button['callback_data'],
                ],
            ];
        }
        return ['inline_keyboard' => $inlineKeyboard];
    }

    /**
     * Handle callback queries from inline keyboards.
     *
     * @param string $callbackQueryId The callback query ID.
     * @param string $text The text to display to the user.
     * @param bool $showAlert Whether to show an alert to the user.
     * @return mixed The result of the callback query handling.
     */
    public function handleCallbackQuery($callbackQueryId, $text, $showAlert = false)
    {
        return $this->MadelineProto->answerCallbackQuery([
            'callback_query_id' => $callbackQueryId,
            'text' => $text,
            'show_alert' => $showAlert,
        ]);
    }

    /**
     * Get information about a user.
     *
     * @param string|int $userId The user ID or username.
     * @return array The user information.
     */
    public function getUserInfo($userId)
    {
        return $this->MadelineProto->getFullInfo($userId);
    }

    /**
     * Restrict a member in a group.
     *
     * @param string|int $chatId The group chat ID.
     * @param string|int $userId The user ID to restrict.
     * @param array $permissions The permissions to apply.
     * @return mixed The result of the restriction.
     */
    public function restrictMember($chatId, $userId, array $permissions)
    {
        return $this->MadelineProto->channels->editBanned([
            'channel' => $chatId,
            'user_id' => $userId,
            'banned_rights' => $permissions,
        ]);
    }

    /**
     * Promote a member in a group.
     *
     * @param string|int $chatId The group chat ID.
     * @param string|int $userId The user ID to promote.
     * @param array $permissions The permissions to grant.
     * @return mixed The result of the promotion.
     */
    public function promoteMember($chatId, $userId, array $permissions)
    {
        return $this->MadelineProto->channels->editAdmin([
            'channel' => $chatId,
            'user_id' => $userId,
            'admin_rights' => $permissions,
        ]);
    }

    /**
     * Upload a file to Telegram servers.
     *
     * @param string $filePath The path to the file.
     * @return string The file ID of the uploaded file.
     */
    public function uploadFile($filePath)
    {
        return $this->MadelineProto->upload($filePath);
    }

    /**
     * Download a file from Telegram servers.
     *
     * @param string $fileId The file ID to download.
     * @param string $destination The destination path for the downloaded file.
     * @return mixed The result of the download operation.
     */
    public function downloadFile($fileId, $destination)
    {
        return $this->MadelineProto->downloadToFile($fileId, $destination);
    }

    /**
     * Define a custom bot command.
     *
     * @param string $command The command to define.
     * @param callable $callback The callback function to handle the command.
     */
    public function defineBotCommand($command, callable $callback)
    {
        $this->MadelineProto->addCommandHandler($command, $callback);
    }

    /**
     * Send location data to a specified peer.
     *
     * @param string|int $peer The username or ID of the recipient.
     * @param float $latitude The latitude of the location.
     * @param float $longitude The longitude of the location.
     * @return mixed The result of the send operation.
     */
    public function sendLocation($peer, $latitude, $longitude)
    {
        return $this->MadelineProto->messages->sendMedia([
            'peer' => $peer,
            'media' => [
                '_' => 'inputMediaGeoPoint',
                'geo_point' => [
                    '_' => 'inputGeoPoint',
                    'lat' => $latitude,
                    'long' => $longitude,
                ],
            ],
        ]);
    }

    /**
     * Send venue information to a specified peer.
     *
     * @param string|int $peer The username or ID of the recipient.
     * @param float $latitude The latitude of the venue.
     * @param float $longitude The longitude of the venue.
     * @param string $title The title of the venue.
     * @param string $address The address of the venue.
     * @return mixed The result of the send operation.
     */
    public function sendVenue($peer, $latitude, $longitude, $title, $address)
    {
        return $this->MadelineProto->messages->sendMedia([
            'peer' => $peer,
            'media' => [
                '_' => 'inputMediaVenue',
                'geo_point' => [
                    '_' => 'inputGeoPoint',
                    'lat' => $latitude,
                    'long' => $longitude,
                ],
                'title' => $title,
                'address' => $address,
            ],
        ]);
    }
}
