@extends('layouts.auth')

@section('title', 'SaaSdeck | Home')

@section('content')

<!-- form -->

<div class="row ">
    <div class="col-md-5 card shade mw-center mh-center">
        <img src="{{ asset('assets/dashboard/svg/logo.svg') }}" alt="..." class="mw-center " height="130" width="300" >
        <hr class="hr-dashed m-0">
        <form method="POST" action="{{ route('register') }}">
            @csrf

        <!-- Name -->
        <div class="form-group m-0">
                <label for="name">{{ __('Name') }}</label>
            
                <input
                    type="text"
                    class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                    id="name"
                    name="name"
                    aria-describedby="nameHelp"
                    placeholder="{{ __('Enter Your Name') }}"
                    value="{{ old('name') }}"
                    required
                    autofocus
                    autocomplete="name"
                />
            
                @if ($errors->has('name'))
                    <small id="nameHelp" class="form-text text-muted">
                        {{ $errors->first('name') }}
                    </small>
                @endif
        </div>

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
        
        <!-- Mobile Number -->
        <div class="form-group m-0">
                <label for="email">{{ __('Mobile Number') }}</label>
            
                <input
                    type="text"
                    class="form-control {{ $errors->has('mobile_number') ? 'is-invalid' : '' }}"
                    id="mobile_number"
                    name="mobile_number"
                    aria-describedby="mobile_numberHelp"
                    placeholder="+9647801234567"
                    value="{{ old('mobile_number') }}"
                    required
                    autofocus
                    autocomplete="mobile_number"
                />
            
                @if ($errors->has('mobile_number'))
                    <small id="mobile_numberHelp" class="form-text text-muted">
                        {{ $errors->first('mobile_number') }}
                    </small>
                @endif
        </div>
        
        <!-- Domain -->
        <div class="form-group m-0">
                <label for="email">{{ __('Domain') }}</label>
            
                <input
                    type="text"
                    class="form-control {{ $errors->has('domain') ? 'is-invalid' : '' }}"
                    id="domain"
                    name="domain"
                    aria-describedby="domainHelp"
                    placeholder="Choose Domain Name"
                    value="{{ old('domain') }}"
                    required
                    autofocus
                    autocomplete="domain"
                />
            
                @if ($errors->has('domain'))
                    <small id="domainHelp" class="form-text text-muted">
                        {{ $errors->first('domain') }}
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
        


            <a class="form-text text-muted" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

                <button type="submit" class="btn shade f-primary btn-block">{{ __('Register') }}</button>
        </form>
    </div>

</div>
@endsection