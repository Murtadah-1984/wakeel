<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Telegram\TelegramController;
use App\Http\Controllers\Telegram\TelegramAuthController;
use App\Http\Controllers\Telegram\TelegramBotController;
use App\Http\Controllers\Telegram\TelegramApiServiceController;
use App\Http\Controllers\TelegramClientController;




/*
|--------------------------------------------------------------------------
| Telegram Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Telegram-related routes for your application.
|
*/
Route::prefix('telegram')->middleware(['auth', 'tenant'])->group(function () {
   
    Route::get('/', [TelegramController::class, 'index'])->name('telegram');
    
    


    // OAuth2 login routes
    Route::get('/telegram/login', [TelegramAuthController::class, 'redirectToProvider'])->name('telegram.login');
    Route::get('/telegram/callback', [TelegramAuthController::class, 'handleProviderCallback'])->name('telegram.callback');
    
    // Telegram Bot API routes
    Route::post('/telegram/bot/send-message', [TelegramBotController::class, 'sendMessage'])->name('telegram.bot.send_message');
    Route::post('/telegram/bot/send-photo', [TelegramBotController::class, 'sendPhoto'])->name('telegram.bot.send_photo');
    // Add more bot API routes as needed...
    
    // Telegram API (MadelineProto) routes
    Route::post('/telegram/api/upload-file', [TelegramApiServiceController::class, 'uploadFile'])->name('telegram.api.upload_file');

    // Route to send a message via MadelineProto
    Route::post('/telegram/api/send-message', [TelegramApiServiceController::class, 'sendApiMessage'])->name('telegram.api.send_message');
    
    // Route to edit a message via MadelineProto
    Route::post('/telegram/api/edit-message', [TelegramApiServiceController::class, 'editApiMessage'])->name('telegram.api.edit_message');
    
    // Route to delete a message via MadelineProto
    Route::post('/telegram/api/delete-message', [TelegramApiServiceController::class, 'deleteApiMessage'])->name('telegram.api.delete_message');
    
    // Route to save a draft message via MadelineProto
    Route::post('/telegram/api/save-draft', [TelegramApiServiceController::class, 'saveApiDraft'])->name('telegram.api.save_draft');
    
    // Route to sync contacts via MadelineProto
    Route::post('/telegram/api/sync-contacts', [TelegramApiServiceController::class, 'syncApiContacts'])->name('telegram.api.sync_contacts');
    
    // Route to search contacts via MadelineProto
    Route::get('/telegram/api/search-contacts', [TelegramApiServiceController::class, 'searchApiContacts'])->name('telegram.api.search_contacts');
    
    Route::get('/telegram/api/search-phone', [TelegramApiServiceController::class, 'searchByPhoneNumber'])->name('telegram.api.search_by_phone');
    
    // Route to create a new chat via MadelineProto
    Route::post('/telegram/api/create-chat', [TelegramApiServiceController::class, 'createApiChat'])->name('telegram.api.create_chat');
    
    // Route to join a channel via MadelineProto
    Route::post('/telegram/api/join-channel', [TelegramApiServiceController::class, 'joinApiChannel'])->name('telegram.api.join_channel');
    
    // Route to leave a channel via MadelineProto
    Route::post('/telegram/api/leave-channel', [TelegramApiServiceController::class, 'leaveApiChannel'])->name('telegram.api.leave_channel');
    
    // Route to upload a file via MadelineProto
    Route::post('/telegram/api/upload-file', [TelegramApiServiceController::class, 'uploadApiFile'])->name('telegram.api.upload_file');
    
    // Route to download a file via MadelineProto
    Route::post('/telegram/api/download-file', [TelegramApiServiceController::class, 'downloadApiFile'])->name('telegram.api.download_file');
    
    // Route to stream media via MadelineProto
    Route::post('/telegram/api/stream-media', [TelegramApiServiceController::class, 'streamApiMedia'])->name('telegram.api.stream_media');
    
    // Route to handle notifications via MadelineProto
    Route::post('/telegram/api/handle-notifications', [TelegramApiServiceController::class, 'handleApiNotifications'])->name('telegram.api.handle_notifications');
    
    // Route to update profile via MadelineProto
    Route::post('/telegram/api/update-profile', [TelegramApiServiceController::class, 'updateApiProfile'])->name('telegram.api.update_profile');
    
    // Route to update privacy settings via MadelineProto
    Route::post('/telegram/api/update-privacy-settings', [TelegramApiServiceController::class, 'updateApiPrivacySettings'])->name('telegram.api.update_privacy_settings');
    
    // Route to create a sticker set via MadelineProto
    Route::post('/telegram/api/create-sticker-set', [TelegramApiServiceController::class, 'createApiStickerSet'])->name('telegram.api.create_sticker_set');
    
    // Route to get emoji suggestions via MadelineProto
    Route::get('/telegram/api/get-emoji-suggestions', [TelegramApiServiceController::class, 'getApiEmojiSuggestions'])->name('telegram.api.get_emoji_suggestions');
    
});