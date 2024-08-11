<?php

namespace App\Http\Controllers\AI;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\AI\OpenAIService;
use Illuminate\Support\Facades\Log;

class OpenAIController extends Controller
{
    protected $openAIService;

    public function __construct(OpenAIService $openAIService)
    {
        $this->openAIService = $openAIService;
    }

    /**
     * Display the chat interface
     */
    public function index()
    {
        $language=(app()->getLocale()=='en'? "english" : "arabic" );
        // Check if the user is authenticated
        if (\Auth::check()) {
            $userName = \Auth::user()->name;

            // Create a personalized greeting message
            $greeting = "Hello, my name is $userName. 
            I would like to receive a wonderful greeting 
            for today and hear a motivational tip. you are my assistant please use $language for this conversation";

            // Initialize conversation with the greeting message
            $conversation = session('conversation', []);

            // Add the greeting to the conversation
            $conversation[] = ['role' => 'user', 'content' => $greeting];

            // Request a response from OpenAI for the greeting
            try {
                $response = $this->openAIService->generateConversation($conversation);

                // Add the AI response to the conversation
                $conversation[] = ['role' => 'assistant', 'content' => $response];

                // Store the updated conversation in the session
                session(['conversation' => $conversation]);

            } catch (\Exception $e) {
                Log::error('Error generating greeting: ' . $e->getMessage());
                $response = 'There was an error generating your greeting. Please try again later.';
            }
        } else {
            return redirect()->route('login')->with('error', 'You must be logged in to access the chat.');
        }

        // Return the view with the conversation
        return view('openai.index', compact('conversation', 'response'));
    }

    /**
     * Handle chat message submission
     */
    public function sendMessage(Request $request)
{
    $request->validate([
        'message' => 'required|string|max:255',
    ]);

    $message = $request->input('message');

    try {
        // Retrieve previous conversation from session
        $conversation = session('conversation', []);

        // Add user message to conversation
        $conversation[] = ['role' => 'user', 'content' => $message];

        // Send conversation to OpenAI
        $response = $this->openAIService->generateConversation($conversation);

        // Add AI response to conversation
        $conversation[] = ['role' => 'assistant', 'content' => $response];

        // Store updated conversation in session
        session(['conversation' => $conversation]);

        // Return JSON response
        return response()->json([
            'message' => $response,
            'conversation' => $conversation
        ]);
    } catch (\Exception $e) {
        \Log::error('Error sending message: ' . $e->getMessage());
        return response()->json(['error' => 'An error occurred while sending the message.'], 500);
    }
}

}
