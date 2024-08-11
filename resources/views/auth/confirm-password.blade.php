@extends('layouts.auth')

@section('title', 'SaaSdeck | Home')

@section('content')
<div class="alert">
        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
</div>
					
<!-- form -->

<div class="row ">
    <div class="col-md-5 card shade mw-center mh-center">
        <img src="{{ asset('assets/dashboard/svg/logo.svg') }}" alt="..." class="mw-center " height="130" width="300" >
        <hr class="hr-dashed m-0">
        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf
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
            <button type="submit" class="btn shade f-primary btn-block">{{ __('Confirm') }}</button>
        </form>
    </div>
</div>
