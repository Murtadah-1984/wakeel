<div class="py-4">
    <div class="col-md-6 card shade full-outlined o-warning">
        <header class="mt-3">
            <h2 class="text-lg font-weight-medium text-dark">
                {{ __('Profile Information') }}
            </h2>

            <p class="mt-1 text-muted">
                {{ __("Update your account's profile information and email address.") }}
            </p>
        </header>

        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
            @csrf
        </form>

        <form method="post" action="{{ route('profile-dash-update') }}" class="mt-4">
            @csrf
            @method('patch')

            <!-- Name -->
            <div class="form-group">
                <label for="name">{{ __('Name') }}</label>
                <input 
                    id="name" 
                    name="name" 
                    type="text" 
                    class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" 
                    value="{{ old('name', $user->name) }}" 
                    required 
                    autofocus 
                    autocomplete="name"
                />
                @if ($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
            </div>

            <!-- Email -->
            <div class="form-group mt-3">
                <label for="email">{{ __('Email') }}</label>
                <input 
                    id="email" 
                    name="email" 
                    type="email" 
                    class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" 
                    value="{{ old('email', $user->email) }}" 
                    required 
                    autocomplete="username"
                />
                @if ($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div class="mt-2">
                        <p class="text-sm text-dark">
                            {{ __('Your email address is unverified.') }}

                            <button 
                                form="send-verification" 
                                class="btn btn-link p-0 align-baseline text-sm text-primary"
                            >
                                {{ __('Click here to re-send the verification email.') }}
                            </button>
                        </p>

                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 font-medium text-sm text-success">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </p>
                        @endif
                    </div>
                @endif
            </div>

            <!-- Save Button -->
            <div class="d-flex align-items-center mt-4">
                <button type="submit" class="btn shade f-primary">
                    {{ __('Save') }}
                </button>

                @if (session('status') === 'profile-updated')
                    <p class="text-sm text-success ml-3 mb-0">
                        {{ __('Saved.') }}
                    </p>
                @endif
            </div>
        </form>
    </div>
</div>
