@extends('layouts.auth')

@section('title', 'SaaSdeck | Home')

@section('content')

<!-- form -->

<div class="row ">
    <div class="col-md-5 card shade mw-center mh-center">
        <img src="{{ asset('assets/dashboard/svg/logo.svg') }}" alt="..." class="mw-center " height="130" width="300" >
        <hr class="hr-dashed m-0">
        <form method="POST" action="{{ route('password.store') }}">
            @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

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
        

        <!-- Password -->
        <div class="form-group m-0">
                <label for="password">{{ __('Password') }}</label>
            
                <input
                    type="password"
                    class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                    id="password"
                    name="password"
                    placeholder="Password"
                    required
                    autocomplete="current-password"
                />
            
                @if ($errors->has('password'))
                    <small id="passwordHelp" class="form-text text-muted">
                        {{ $errors->first('password') }}
                    </small>
                @endif
        </div>

        <!-- Confirm Password -->
        <div class="form-group m-0">
                <label for="password_confirmation">{{ __('Confirm Password') }}</label>
            
                <input
                    type="password"
                    class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}"
                    id="password_confirmation"
                    name="password_confirmation"
                    placeholder="Password"
                    required
                    autocomplete="new-password"
                />
            
                @if ($errors->has('password_confirmation'))
                    <small id="passwordHelp" class="form-text text-muted">
                        {{ $errors->first('password_confirmation') }}
                    </small>
                @endif
        </div>

                <button type="submit" class="btn shade f-primary btn-block">{{ __('Reset Now') }}</button>
        </form>
    </div>

</div>
@endsection