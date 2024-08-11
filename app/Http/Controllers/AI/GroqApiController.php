<?php

namespace App\Http\Controllers\AI;

use App\Http\Controllers\Controller;
use App\Services\AI\GroqApiService;
use Illuminate\Http\Request;

class GroqApiController extends Controller
{
    protected $grogApiService;

    public function __construct(GrogApiService $grogApiService)
    {
        $this->grogApiService = $grogApiService;
    }

    public function sendChatCompletion(Request $request)
    {
        $validated = $request->validate([
            'messages' => 'required|array',
            'model' => 'required|string',
            'temperature' => 'required|numeric',
            'max_tokens' => 'required|integer',
            'top_p' => 'required|numeric',
            'stream' => 'required|boolean',
            'stop' => 'nullable|array',
        ]);

        $response = $this->grogApiService->sendRequest($validated);

        return response()->json($response);
    }
}
