@extends('layouts.auth')

@section('title', 'SaaSdeck | Home')

@section('content')

					
<!-- form -->

<div class="row ">
    <div class="col-md-5 card shade mw-center mh-center">
        <img src="{{ asset('assets/dashboard/svg/logo.svg') }}" alt="..." class="mw-center " height="130" width="300" >
        <hr class="hr-dashed m-0">
        <form method="POST" action="{{ route('login') }}" >
             @csrf
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

            <div class="form-check pt-2">
                <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
                <label class="form-check-label" for="remember_me">{{ __('Remember me') }}</label>
            </div>
            <button type="submit" class="btn shade f-primary btn-block">{{ __('Log in') }}</button>
        </form>
    </div>

</div>



@endsection