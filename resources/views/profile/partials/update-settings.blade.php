@extends('layouts.dashboard.app')

@section('content')


<div class="container mt-5">
    <h2 class="font-weight-semibold text-dark display-4 text-center">
        {{ __('Settings') }}
    </h2>

    <div class="row justify-content-center mt-4">
        <div class="col-lg-8">
            <div class="card shadow p-4">
                <form method="post" action="{{ route('profile.settings.update') }}">
                    @csrf
                    @method('patch')

                    <!-- Dark Mode Setting -->
                    <div class="form-group">
                        <label for="dark_mode">{{ __('Dark Mode') }}</label>
                        <select id="dark_mode" name="settings[dark_mode]" class="form-control">
                            <option value="off" {{ $profile->settings['dark_mode'] === 'off' ? 'selected' : '' }}>{{ __('Off') }}</option>
                            <option value="on" {{ $profile->settings['dark_mode'] === 'on' ? 'selected' : '' }}>{{ __('On') }}</option>
                        </select>
                    </div>

                    <!-- Notification Setting -->
                    <div class="form-group mt-3">
                        <label for="notifications">{{ __('Notifications') }}</label>
                        <select id="notifications" name="settings[notifications]" class="form-control">
                            <option value="enabled" {{ $profile->settings['notifications'] === 'enabled' ? 'selected' : '' }}>{{ __('Enabled') }}</option>
                            <option value="disabled" {{ $profile->settings['notifications'] === 'disabled' ? 'selected' : '' }}>{{ __('Disabled') }}</option>
                        </select>
                    </div>

                    <!-- Language Setting -->
                    <div class="form-group mt-3">
                        <label for="language">{{ __('Language') }}</label>
                        <select id="language" name="settings[language]" class="form-control">
                            <option value="en" {{ $profile->settings['language'] === 'en' ? 'selected' : '' }}>{{ __('English') }}</option>
                            <option value="es" {{ $profile->settings['language'] === 'es' ? 'selected' : '' }}>{{ __('Spanish') }}</option>
                            <!-- Add other languages as needed -->
                        </select>
                    </div>

                    <!-- Save Button -->
                    <div class="d-flex justify-content-end mt-4">
                        <button type="submit" class="btn shade f-primary">
                            {{ __('Save Settings') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>





@endsection