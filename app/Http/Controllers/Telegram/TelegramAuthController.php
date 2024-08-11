<?php

namespace App\Http\Controllers\Telegram;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

/**
 * TelegramAuthController
 *
 * Handles OAuth2 login for Telegram authentication.
 */
class TelegramAuthController extends Controller
{
    /**
     * Redirect to the Telegram OAuth2 login page.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirectToProvider()
    {
        // Assuming we have a configured Socialite provider for Telegram
        return \Socialite::driver('telegram')->redirect();
    }

    /**
     * Handle the callback from Telegram after authentication.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleProviderCallback(Request $request)
    {
        try {
            $user = \Socialite::driver('telegram')->user();

            // Find or create a user in your database
            $authUser = $this->findOrCreateUser($user);

            // Log the user in
            Auth::login($authUser, true);

            return redirect()->route('telegram.index')->with('success', 'Logged in successfully!');
        } catch (\Exception $e) {
            return redirect()->route('telegram.index')->with('error', 'Failed to authenticate with Telegram: ' . $e->getMessage());
        }
    }

    /**
     * Find or create a user in the database.
     *
     * @param \Laravel\Socialite\Two\User $telegramUser
     * @return \App\Models\User
     */
    protected function findOrCreateUser($telegramUser)
    {
        // Assuming you have a User model and users table with a telegram_id column
        return \App\Models\User::firstOrCreate(
            ['telegram_id' => $telegramUser->getId()],
            [
                'name' => $telegramUser->getName(),
                'email' => $telegramUser->getEmail(), // May need adjustment as Telegram might not provide an email
                'avatar' => $telegramUser->getAvatar(),
            ]
        );
    }
    
    
}
