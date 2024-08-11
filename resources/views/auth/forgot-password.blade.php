@extends('layouts.auth')

@section('title', 'SaaSdeck | Home')

@section('content')

<!-- form -->

<div class="row ">
    <div class="col-md-5 card shade mw-center mh-center">
        <img src="{{ asset('assets/dashboard/svg/logo.svg') }}" alt="..." class="mw-center " height="130" width="300" >
        <hr class="hr-dashed m-0">
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

 <!-- Session Status -->
@if (session('status'))
    <div class="mb-4 text-green-600">
        {{ session('status') }}
    </div>
@endif


    <form method="POST" action="{{ route('password.email') }}">
        @csrf

         <!-- Email Address -->
        <div class="form-group m-0">
                <label for="email">{{ __('Email') }}</label>
            
                <input
                    type="email"
                    class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                    id="email"
                    name="email"
                    aria-describedby="emailHelp"
                    placeholder="Enter email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    autocomplete="username"
                />
            
                @if ($errors->has('email'))
                    <small id="emailHelp" class="form-text text-muted">
                        {{ $errors->first('email') }}
                    </small>
                @endif
        </div>

        <button type="submit" class="btn shade f-primary btn-block">
                {{ __('Email Password Reset Link') }}
        </button>
        
    </form>
  </div>

</div>
@endsection
