<?php

namespace App\Services\Telegram;

use danog\MadelineProto\API;
use danog\MadelineProto\Settings\AppInfo;
use danog\MadelineProto\Settings\Connection;
use Illuminate\Support\Facades\Log;


/**
 * TelegramApiService
 *
 * This service provides methods for interacting with Telegram using MadelineProto.
 */
class TelegramApiService
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
        $this->MadelineProto =new API(storage_path('app/telegram_session.madeline'), $settings);

        // Start the MadelineProto API session
        $this->MadelineProto->start();
    }


    // ==================== Account Management ====================

    /**
     * Login to Telegram with phone number.
     *
     * @param string $phoneNumber The phone number to login with.
     * @return void
     */
    public function login($phoneNumber)
    {
        $this->MadelineProto->phoneLogin($phoneNumber);
    }

    /**
     * Complete login with the code received via SMS.
     *
     * @param string $code The code received via SMS.
     * @return void
     */
    public function completeLogin($code)
    {
        $this->MadelineProto->completePhoneLogin($code);
    }

    /**
     * Logout from Telegram.
     *
     * @return void
     */
    public function logout()
    {
        $this->MadelineProto->logout();
    }

    /**
     * Enable two-step verification.
     *
     * @param string $password The password for two-step verification.
     * @return void
     */
    public function enableTwoStepVerification($password)
    {
        $this->MadelineProto->account->setPassword(['new_password' => $password]);
    }

    // ==================== Messaging ====================

    /**
     * Send a message to a specified peer.
     *
     * @param string|int $peer The username or ID of the recipient.
     * @param string $message The message text to send.
     * @return mixed The result of the send operation.
     */
    public function sendMessage($peer, $message)
    {
        return $this->MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => $message]);
    }

    /**
     * Receive messages from a specified peer.
     *
     * @param string|int $peer The username or ID of the peer.
     * @return array The messages received.
     */
    public function receiveMessages($peer)
    {
        return $this->MadelineProto->getMessages(['peer' => $peer]);
    }
    
    /**
     * Search for a user by phone number.
     *
     * @param string $phoneNumber The phone number to search.
     * @return array|null The user's information if found, otherwise null.
     */
     public function searchByPhoneNumber($phoneNumber)
    {
        try {
            // Log the phone number being searched
            Log::info('Searching for phone number: ' . $phoneNumber);

            // Resolve the phone number to a user
            $result = $this->MadelineProto->contacts->resolvePhone(['phone' => $phoneNumber]);

            // Log the response from the API
            Log::info('API Response: ' . json_encode($result));

            if (isset($result['users']) && count($result['users']) > 0) {
                $user = $result['users'][0];
                $userInfo = [
                    'id' => $user['id'],
                    'first_name' => $user['first_name'],
                    'last_name' => $user['last_name'],
                    'username' => $user['username'] ?? null,
                    'phone' => $user['phone'] ?? null,
                ];
                Log::info('User found: ' . json_encode($userInfo));
                return $userInfo;
            }

            Log::info('No user found for the phone number: ' . $phoneNumber);
            return null;
        } catch (Exception $e) {
            Log::error('Error searching by phone number: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Edit a sent message.
     *
     * @param string|int $peer The username or ID of the recipient.
     * @param int $messageId The ID of the message to edit.
     * @param string $newMessage The new message text.
     * @return mixed The result of the edit operation.
     */
    public function editMessage($peer, $messageId, $newMessage)
    {
        return $this->MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $messageId, 'message' => $newMessage]);
    }

    /**
     * Delete a sent message.
     *
     * @param string|int $peer The username or ID of the recipient.
     * @param int $messageId The ID of the message to delete.
     * @return mixed The result of the delete operation.
     */
    public function deleteMessage($peer, $messageId)
    {
        return $this->MadelineProto->messages->deleteMessages(['peer' => $peer, 'id' => [$messageId]]);
    }

    /**
     * Save a draft message.
     *
     * @param string|int $peer The username or ID of the recipient.
     * @param string $message The draft message text.
     * @return mixed The result of the save draft operation.
     */
    public function saveDraft($peer, $message)
    {
        return $this->MadelineProto->messages->saveDraft(['peer' => $peer, 'message' => $message]);
    }

    // ==================== Contacts ====================

    /**
     * Sync contacts with Telegram.
     *
     * @param array $contacts An array of contacts to sync.
     * @return mixed The result of the sync operation.
     */
    public function syncContacts(array $contacts)
    {
        return $this->MadelineProto->contacts->importContacts(['contacts' => $contacts]);
    }

    /**
     * Search for a contact by username or ID.
     *
     * @param string $query The query string to search for.
     * @return mixed The search results.
     */
    public function searchContacts($query)
    {
        return $this->MadelineProto->contacts->search(['q' => $query]);
    }

    // ==================== Chats and Channels ====================

    /**
     * Create a new chat.
     *
     * @param array $users An array of user IDs to include in the chat.
     * @param string $title The title of the chat.
     * @return mixed The result of the create chat operation.
     */
    public function createChat(array $users, $title)
    {
        return $this->MadelineProto->messages->createChat(['users' => $users, 'title' => $title]);
    }

    /**
     * Join a channel by username or ID.
     *
     * @param string|int $channel The username or ID of the channel.
     * @return mixed The result of the join operation.
     */
    public function joinChannel($channel)
    {
        return $this->MadelineProto->channels->joinChannel(['channel' => $channel]);
    }

    /**
     * Leave a channel by username or ID.
     *
     * @param string|int $channel The username or ID of the channel.
     * @return mixed The result of the leave operation.
     */
    public function leaveChannel($channel)
    {
        return $this->MadelineProto->channels->leaveChannel(['channel' => $channel]);
    }

    // ==================== Media and Files ====================

    /**
     * Upload a file to Telegram servers.
     *
     * @param string $filePath The path to the file to upload.
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
     * Stream video or audio file.
     *
     * @param string $fileId The file ID to stream.
     * @param int $offset The offset to start streaming from.
     * @return resource The streaming resource.
     */
    public function streamMedia($fileId, $offset = 0)
    {
        return $this->MadelineProto->getStream($fileId, $offset);
    }

    /**
     * Handle notifications for messages and events.
     *
     * @param callable $callback The callback function to handle notifications.
     * @return void
     */
    public function handleNotifications(callable $callback)
    {
        $this->MadelineProto->setEventHandler($callback);
    }

    // ==================== Profile and Settings ====================

    /**
     * Update user profile information.
     *
     * @param array $profileData An array containing profile information.
     * @return mixed The result of the update operation.
     */
    public function updateProfile(array $profileData)
    {
        return $this->MadelineProto->account->updateProfile($profileData);
    }

    /**
     * Update user privacy settings.
     *
     * @param array $privacySettings An array containing privacy settings.
     * @return mixed The result of the update operation.
     */
    public function updatePrivacySettings(array $privacySettings)
    {
        return $this->MadelineProto->account->setPrivacy($privacySettings);
    }

    // ==================== Stickers and Emojis ====================

    /**
     * Create a new sticker set.
     *
     * @param string $title The title of the sticker set.
     * @param string $shortName The short name for the sticker set.
     * @param array $stickers An array of sticker files and emojis.
     * @return mixed The result of the create operation.
     */
    public function createStickerSet($title, $shortName, array $stickers)
    {
        return $this->MadelineProto->stickers->createStickerSet([
            'title' => $title,
            'short_name' => $shortName,
            'stickers' => $stickers,
        ]);
    }

    /**
     * Get emoji suggestions for a text input.
     *
     * @param string $text The text input to get emoji suggestions for.
     * @return array The emoji suggestions.
     */
    public function getEmojiSuggestions($text)
    {
        return $this->MadelineProto->messages->getEmojiKeywords(['keyword' => $text]);
    }
}

