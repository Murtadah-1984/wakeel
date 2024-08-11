@extends('layouts.dashboard.app')

@section('title', 'SaaSdeck | Home')

@section('content')
<!DOCTYPE html>

<h1>Telegram Updates</h1>
    <button id="get-updates">Get Updates</button>
    <div id="updates"></div>

    <script>
        document.getElementById('get-updates').addEventListener('click', function() {
            fetch('/api/telegram/get-updates')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok ' + response.statusText);
                    }
                    return response.json();
                })
                .then(data => {
                    const updatesDiv = document.getElementById('updates');
                    updatesDiv.innerHTML = ''; // Clear previous updates
                    if (data.result && data.result.length > 0) {
                        data.result.forEach(update => {
                            const updateDiv = document.createElement('div');
                            updateDiv.className = 'update';
                            updateDiv.textContent = JSON.stringify(update, null, 2);
                            updatesDiv.appendChild(updateDiv);
                        });
                    } else {
                        updatesDiv.textContent = 'No updates available.';
                    }
                })
                .catch(error => {
                    console.error('Error fetching updates:', error);
                    document.getElementById('updates').textContent = 'Error fetching updates: ' + error;
                });
        });
    </script>
    <div class="container mt-5">
        <h2>Search Telegram User by Phone Number</h2>

        <!-- Display Success and Error Messages -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <!-- Search Form -->
        <form action="{{ route('telegram.api.search_by_phone') }}" method="GET" class="mb-4">
            @csrf
            <div class="input-group">
                <input type="text" name="phone_number" class="form-control" placeholder="Enter phone number" required>
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </form>

        <!-- Display Search Result -->
        @isset($result)
            <h3>User Information</h3>
            <ul class="list-group">
                <li class="list-group-item"><strong>Name:</strong> {{ $result['first_name'] }} {{ $result['last_name'] }}</li>
                <li class="list-group-item"><strong>Username:</strong> {{ $result['username'] ?? 'N/A' }}</li>
                <li class="list-group-item"><strong>ID:</strong> {{ $result['id'] }}</li>
                <li class="list-group-item"><strong>Phone:</strong> {{ $result['phone'] ?? 'N/A' }}</li>
            </ul>
        @endisset
    </div>




<script async src="https://telegram.org/js/telegram-widget.js?7"
            data-telegram-login="MurtadahHaddadBot"
            data-size="large"
            data-radius="10"
            data-auth-url="{{ url('/auth/telegram/callback') }}"
            data-request-access="write"></script>
@endsection