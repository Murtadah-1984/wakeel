<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API Rate Limits</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">API Rate Limits</h2>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <!-- Display Existing Rate Limits -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>API Name</th>
                <th>Max Attempts</th>
                <th>Decay Minutes</th>
            </tr>
        </thead>
        <tbody>
            @foreach($apiLimits as $apiName => $limit)
                <tr>
                    <td>{{ $apiName }}</td>
                    <td>{{ $limit['max_attempts'] }}</td>
                    <td>{{ $limit['decay_minutes'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Form to Add or Edit Rate Limit -->
    <h4 class="mt-5">Add or Edit Rate Limit</h4>
    <form action="{{ route('api-limits.update') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="api_name" class="form-label">API Name</label>
            <input type="text" class="form-control" id="api_name" name="api_name" required>
        </div>
        <div class="mb-3">
            <label for="max_attempts" class="form-label">Max Attempts</label>
            <input type="number" class="form-control" id="max_attempts" name="max_attempts" required>
        </div>
        <div class="mb-3">
            <label for="decay_minutes" class="form-label">Decay Minutes</label>
            <input type="number" class="form-control" id="decay_minutes" name="decay_minutes" required>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
