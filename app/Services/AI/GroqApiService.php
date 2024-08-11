<?php

namespace App\Services\AI;

use Illuminate\Support\Facades\Http;

class GroqApiService
{
    protected $apiKey;
    protected $baseUrl;

    public function __construct()
    {
        $this->apiKey = env('GROQ_API_KEY');
        $this->baseUrl = 'https://api.groq.com/openai/v1/chat/completions';
    }

    public function sendRequest(array $data)
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => "Bearer {$this->apiKey}",
        ])->post($this->baseUrl, $data);

        return $response->json();
    }
}
