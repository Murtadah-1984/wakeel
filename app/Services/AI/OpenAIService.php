<?php

namespace App\Services\AI;

use Illuminate\Support\Facades\Http;

class OpenAIService
{
    protected $apiKey;
    protected $apiUrl;

    public function __construct()
    {
        $this->apiKey = config('services.openai.api_key');
        $this->apiUrl = 'https://api.openai.com/v1/chat/completions'; // Correct endpoint for chat models
    }

    /**
     * Generate a response using OpenAI's chat model
     *
     * @param array $conversation
     * @return string
     */
    public function generateConversation(array $conversation)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type' => 'application/json',
        ])->post($this->apiUrl, [
            'model' => 'gpt-4o-mini-2024-07-18',  // Specify the correct chat model
            'messages' => $conversation,
            'max_tokens' => 400,
            'temperature' => 0.7,
        ]);

        if ($response->successful()) {
            return $response->json()['choices'][0]['message']['content'];
        }

        // Log the error for debugging purposes
        \Log::error('OpenAI API Error: ' . $response->body());

        return 'Error generating response: ' . ($response->json()['error']['message'] ?? 'Unknown error');
    }
    
    public function loadKnowledgeBase()
    {
        $path = base_path('knowledge_base.json'); // or 'knowledge_base.md'
        $content = File::get($path);
        return json_decode($content, true);
    }

    /**
     * Generate a response using OpenAI's chat model with knowledge base
     *
     * @param string $message
     * @return string
     */
    public function generateResponseWithKnowledgeBase($message)
    {
        $knowledgeBase = $this->loadKnowledgeBase();

        // Add knowledge base context to the message
        $messages = [
            ['role' => 'system', 'content' => 'Use the following knowledge base to answer questions.'],
            ['role' => 'system', 'content' => json_encode($knowledgeBase)],
            ['role' => 'user', 'content' => $message],
        ];

        return $this->generateConversation($messages);
    }

}
