@extends('layouts.dashboard.app')

@section('content')
<div class="container">
    <h1>Chat with AI</h1>
    <div id="chat-box" class="chat-box">
        @foreach($conversation as $message)
            <div class="chat-message {{ $message['role'] === 'user' ? 'user-message' : 'ai-message' }}">
                <strong>{{ $message['role'] === 'user' ? 'You' : 'AI' }}:</strong> {{ $message['content'] }}
            </div>
        @endforeach
    </div>
    <div class="input-group mt-3">
        <input type="text" id="user-message" class="form-control" placeholder="Type your message..." aria-label="User Message">
        <button class="btn btn-primary" id="send-button" type="button">Send</button>
    </div>
</div>

<style>
    .chat-box {
        border: 1px solid #ccc;
        padding: 10px;
        height: 400px;
        overflow-y: auto;
        margin-bottom: 10px;
        background-color: #f8f8f8;
    }
    .chat-message {
        margin-bottom: 10px;
        padding: 8px;
        border-radius: 5px;
    }
    .user-message {
        background-color: #d4edda;
        text-align: right;
    }
    .ai-message {
        background-color: #d1ecf1;
    }
    .error-message {
        background-color: #f8d7da;
        text-align: center;
        color: #721c24;
    }
</style>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const sendButton = document.getElementById('send-button');
        const userMessageInput = document.getElementById('user-message');
        const chatBox = document.getElementById('chat-box');

        sendButton.addEventListener('click', sendMessage);

        // Trigger send on Enter key
        userMessageInput.addEventListener('keydown', function(event) {
            if (event.key === 'Enter') {
                sendMessage();
            }
        });

        function sendMessage() {
            const message = userMessageInput.value.trim();
            if (message !== '') {
                appendMessage(message, 'user');

                // Clear input field
                userMessageInput.value = '';

                // Send message to server
                fetch('{{ route('chat.message') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ message: message })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.message) {
                        appendMessage(data.message, 'ai');
                    } else if (data.error) {
                        console.error(data.error);
                        appendMessage('There was an error processing your request.', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    appendMessage('There was an error processing your request.', 'error');
                });
            }
        }

        function appendMessage(message, role) {
            const messageDiv = document.createElement('div');
            messageDiv.classList.add('chat-message');

            if (role === 'user') {
                messageDiv.classList.add('user-message');
                messageDiv.innerHTML = `<strong>You:</strong> ${message}`;
            } else if (role === 'ai') {
                messageDiv.classList.add('ai-message');
                messageDiv.innerHTML = `<strong>AI:</strong> ${message}`;
            } else {
                messageDiv.classList.add('error-message');
                messageDiv.textContent = message;
            }

            chatBox.appendChild(messageDiv);
            chatBox.scrollTop = chatBox.scrollHeight; // Scroll to bottom
        }
    });
</script>

@endsection
