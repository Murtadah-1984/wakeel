<?php

namespace App\Http\Controllers\Telegram;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * TelegramController
 *
 * Handles the display of the main Telegram operations view.
 */
class TelegramController extends Controller
{
    /**
     * Display the main Telegram index view.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('telegram.index');
    }
}
