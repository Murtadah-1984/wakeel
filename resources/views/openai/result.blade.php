@extends('layouts.dashboard.app')

@section('title', 'AI | ChatGPT')

@section('content')
	<div class="container">
    <h1>Generated Text</h1>
    <p>{{ $response }}</p>
    <a href="{{ route('openai.index') }}" class="btn btn-secondary">Generate Again</a>
</div>
@endsection