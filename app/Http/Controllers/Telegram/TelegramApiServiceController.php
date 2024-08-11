<?php

namespace App\Http\Controllers\Telegram;

use Illuminate\Http\Request;
use App\Services\Telegram\TelegramApiService;
use App\Http\Controllers\Controller;

/**
 * TelegramApiServiceController
 *
 * Handles all available methods in TelegramApiService.
 */
class TelegramApiServiceController extends Controller
{
    protected $apiService;

    /**
     * Constructor to initialize TelegramApiService.
     *
     * @param TelegramApiService $apiService
     */
    public function __construct(TelegramApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    /**
     * Send a message via MadelineProto.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendMessage(Request $request)
    {
        $request->validate([
            'peer' => 'required|string',
            'message' => 'required|string',
        ]);

        $peer = $request->input('peer');
        $message = $request->input('message');

        try {
            $this->apiService->sendMessage($peer, $message);
            return redirect()->back()->with('success', 'Message sent successfully via MadelineProto!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to send message via MadelineProto: ' . $e->getMessage());
        }
    }

     /**
     * Send a message via MadelineProto.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendApiMessage(Request $request)
    {
        $request->validate([
            'peer' => 'required|string',
            'message' => 'required|string',
        ]);

        $peer = $request->input('peer');
        $message = $request->input('message');

        try {
            $this->apiService->sendMessage($peer, $message);
            return redirect()->back()->with('success', 'Message sent successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to send message: ' . $e->getMessage());
        }
    }

    /**
     * Edit a message via MadelineProto.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function editApiMessage(Request $request)
    {
        $request->validate([
            'peer' => 'required|string',
            'message_id' => 'required|integer',
            'new_message' => 'required|string',
        ]);

        $peer = $request->input('peer');
        $messageId = $request->input('message_id');
        $newMessage = $request->input('new_message');

        try {
            $this->apiService->editMessage($peer, $messageId, $newMessage);
            return redirect()->back()->with('success', 'Message edited successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to edit message: ' . $e->getMessage());
        }
    }

    /**
     * Delete a message via MadelineProto.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteApiMessage(Request $request)
    {
        $request->validate([
            'peer' => 'required|string',
            'message_id' => 'required|integer',
        ]);

        $peer = $request->input('peer');
        $messageId = $request->input('message_id');

        try {
            $this->apiService->deleteMessage($peer, $messageId);
            return redirect()->back()->with('success', 'Message deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete message: ' . $e->getMessage());
        }
    }

    /**
     * Save a draft message via MadelineProto.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveApiDraft(Request $request)
    {
        $request->validate([
            'peer' => 'required|string',
            'message' => 'required|string',
        ]);

        $peer = $request->input('peer');
        $message = $request->input('message');

        try {
            $this->apiService->saveDraft($peer, $message);
            return redirect()->back()->with('success', 'Draft saved successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to save draft: ' . $e->getMessage());
        }
    }

    /**
     * Sync contacts via MadelineProto.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function syncApiContacts(Request $request)
    {
        $request->validate([
            'contacts' => 'required|array',
        ]);

        $contacts = $request->input('contacts');

        try {
            $this->apiService->syncContacts($contacts);
            return redirect()->back()->with('success', 'Contacts synced successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to sync contacts: ' . $e->getMessage());
        }
    }

    /**
     * Search contacts via MadelineProto.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function searchApiContacts(Request $request)
    {
        $request->validate([
            'query' => 'required|string',
        ]);

        $query = $request->input('query');

        try {
            $results = $this->apiService->searchContacts($query);
            return view('telegram.index', compact('results'))->with('success', 'Contacts found!');
        } catch (\Exception $e) {
            return view('telegram.index')->with('error', 'Failed to search contacts: ' . $e->getMessage());
        }
    }

    /**
     * Create a new chat via MadelineProto.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createApiChat(Request $request)
    {
        $request->validate([
            'users' => 'required|array',
            'title' => 'required|string',
        ]);

        $users = $request->input('users');
        $title = $request->input('title');

        try {
            $this->apiService->createChat($users, $title);
            return redirect()->back()->with('success', 'Chat created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create chat: ' . $e->getMessage());
        }
    }

    /**
     * Join a channel via MadelineProto.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function joinApiChannel(Request $request)
    {
        $request->validate([
            'channel' => 'required|string',
        ]);

        $channel = $request->input('channel');

        try {
            $this->apiService->joinChannel($channel);
            return redirect()->back()->with('success', 'Joined channel successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to join channel: ' . $e->getMessage());
        }
    }

    /**
     * Leave a channel via MadelineProto.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function leaveApiChannel(Request $request)
    {
        $request->validate([
            'channel' => 'required|string',
        ]);

        $channel = $request->input('channel');

        try {
            $this->apiService->leaveChannel($channel);
            return redirect()->back()->with('success', 'Left channel successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to leave channel: ' . $e->getMessage());
        }
    }

    /**
     * Upload a file via MadelineProto.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function uploadApiFile(Request $request)
    {
        $request->validate([
            'file_path' => 'required|string',
        ]);

        $filePath = $request->input('file_path');

        try {
            $this->apiService->uploadFile($filePath);
            return redirect()->back()->with('success', 'File uploaded successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to upload file: ' . $e->getMessage());
        }
    }

    /**
     * Download a file via MadelineProto.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function downloadApiFile(Request $request)
    {
        $request->validate([
            'file_id' => 'required|string',
            'destination' => 'required|string',
        ]);

        $fileId = $request->input('file_id');
        $destination = $request->input('destination');

        try {
            $this->apiService->downloadFile($fileId, $destination);
            return redirect()->back()->with('success', 'File downloaded successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to download file: ' . $e->getMessage());
        }
    }

    /**
     * Stream media via MadelineProto.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function streamApiMedia(Request $request)
    {
        $request->validate([
            'file_id' => 'required|string',
            'offset' => 'nullable|integer',
        ]);

        $fileId = $request->input('file_id');
        $offset = $request->input('offset', 0);

        try {
            $this->apiService->streamMedia($fileId, $offset);
            return redirect()->back()->with('success', 'Media streamed successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to stream media: ' . $e->getMessage());
        }
    }

    /**
     * Handle notifications via MadelineProto.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleApiNotifications()
    {
        try {
            $response = $this->apiService->handleNotifications(function ($update) {
                // Implement your notification handling logic here
                return $update;
            });

            return redirect()->back()->with('success', 'Notifications handled successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to handle notifications: ' . $e->getMessage());
        }
    }

    /**
     * Update profile via MadelineProto.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateApiProfile(Request $request)
    {
        $request->validate([
            'profile_data' => 'required|array',
        ]);

        $profileData = $request->input('profile_data');

        try {
            $this->apiService->updateProfile($profileData);
            return redirect()->back()->with('success', 'Profile updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update profile: ' . $e->getMessage());
        }
    }

    /**
     * Update privacy settings via MadelineProto.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateApiPrivacySettings(Request $request)
    {
        $request->validate([
            'privacy_settings' => 'required|array',
        ]);

        $privacySettings = $request->input('privacy_settings');

        try {
            $this->apiService->updatePrivacySettings($privacySettings);
            return redirect()->back()->with('success', 'Privacy settings updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update privacy settings: ' . $e->getMessage());
        }
    }

    /**
     * Create a sticker set via MadelineProto.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createApiStickerSet(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'short_name' => 'required|string',
            'stickers' => 'required|array',
        ]);

        $title = $request->input('title');
        $shortName = $request->input('short_name');
        $stickers = $request->input('stickers');

        try {
            $this->apiService->createStickerSet($title, $shortName, $stickers);
            return redirect()->back()->with('success', 'Sticker set created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create sticker set: ' . $e->getMessage());
        }
    }

    /**
     * Get emoji suggestions via MadelineProto.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function getApiEmojiSuggestions(Request $request)
    {
        $request->validate([
            'text' => 'required|string',
        ]);

        $text = $request->input('text');

        try {
            $suggestions = $this->apiService->getEmojiSuggestions($text);
            return view('telegram.index', compact('suggestions'))->with('success', 'Emoji suggestions retrieved successfully!');
        } catch (\Exception $e) {
            return view('telegram.index')->with('error', 'Failed to retrieve emoji suggestions: ' . $e->getMessage());
        }
    }
    
    /**
     * Search for a user by phone number.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function searchByPhoneNumber(Request $request)
    {
        $request->validate([
            'phone_number' => 'required|string',
        ]);

        $phoneNumber = $request->input('phone_number');

        try {
            $result = $this->apiService->searchByPhoneNumber($phoneNumber);

            if ($result) {
                return view('telegram.index', compact('result'))->with('success', 'User found!');
            } else {
                return view('telegram.index')->with('error', 'No user found with this phone number.');
            }
        } catch (\Exception $e) {
            return view('telegram.index')->with('error', 'Failed to search: ' . $e->getMessage());
        }
    }
}
