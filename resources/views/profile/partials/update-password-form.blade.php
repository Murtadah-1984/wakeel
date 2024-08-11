<div class="py-4">
    <div class="col-md-6 card shade full-outlined o-warning">
        <header class="mt-3">
            <h2 class="text-lg font-weight-medium text-dark">
                {{ __('Update Password') }}
            </h2>

            <p class="mt-1 text-muted">
                {{ __('Ensure your account is using a long, random password to stay secure.') }}
            </p>
        </header>

        <form method="post" action="{{ route('profile-dash-update') }}" class="mt-4">
            @csrf
            @method('put')

            <!-- Current Password -->
            <div class="form-group">
                <label for="update_password_current_password">{{ __('Current Password') }}</label>
                <input
                    id="update_password_current_password"
                    name="current_password"
                    type="password"
                    class="form-control {{ $errors->updatePassword->has('current_password') ? 'is-invalid' : '' }}"
                    autocomplete="current-password"
                />
                @if ($errors->updatePassword->has('current_password'))
                    <div class="invalid-feedback">
                        {{ $errors->updatePassword->first('current_password') }}
                    </div>
                @endif
            </div>

            <!-- New Password -->
            <div class="form-group mt-3">
                <label for="update_password_password">{{ __('New Password') }}</label>
                <input
                    id="update_password_password"
                    name="password"
                    type="password"
                    class="form-control {{ $errors->updatePassword->has('password') ? 'is-invalid' : '' }}"
                    autocomplete="new-password"
                />
                @if ($errors->updatePassword->has('password'))
                    <div class="invalid-feedback">
                        {{ $errors->updatePassword->first('password') }}
                    </div>
                @endif
            </div>

            <!-- Confirm Password -->
            <div class="form-group mt-3">
                <label for="update_password_password_confirmation">{{ __('Confirm Password') }}</label>
                <input
                    id="update_password_password_confirmation"
                    name="password_confirmation"
                    type="password"
                    class="form-control {{ $errors->updatePassword->has('password_confirmation') ? 'is-invalid' : '' }}"
                    autocomplete="new-password"
                />
                @if ($errors->updatePassword->has('password_confirmation'))
                    <div class="invalid-feedback">
                        {{ $errors->updatePassword->first('password_confirmation') }}
                    </div>
                @endif
            </div>

            <!-- Save Button -->
            <div class="d-flex align-items-center mt-4">
                <button type="submit" class="btn shade f-primary">
                    {{ __('Save') }}
                </button>

                @if (session('status') === 'password-updated')
                    <p class="text-sm text-success ml-3 mb-0">
                        {{ __('Saved.') }}
                    </p>
                @endif
            </div>
        </form>
    </div>
</div>
