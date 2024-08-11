<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\VonageService;

class SmsController extends Controller
{
    protected $vonageService;

    public function __construct(VonageService $vonageService)
    {
        $this->vonageService = $vonageService;
    }

    public function sendSms(Request $request)
    {
        $request->validate([
            'phone' => 'required|string',
            'message' => 'required|string',
        ]);

        $response = $this->vonageService->sendSms($request->phone, $request->message);

        if ($response['success']) {
            return back()->with('status', $response['message']);
        } else {
            return back()->withErrors(['error' => $response['message']]);
        }
    }
}

