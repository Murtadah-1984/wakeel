<div class="py-4">
    <div class="col-md-6 card shade full-outlined o-warning">
        <header class="mt-3">
            <h2 class="text-lg font-weight-medium text-dark">
                {{ __('Update Avatar') }}
            </h2>

            <p class="mt-1 text-muted">
                {{ __("Upload a new avatar for your profile.") }}
            </p>
        </header>

        <form method="post" action="{{ route('dashboard.avatar.update') }}" class="mt-4">
            @csrf
            @method('patch')

            <!-- Current Avatar Display -->
            <div class="form-group text-center">
                <img src="{{ asset('storage/' . $user->avatar) }}" alt="Current Avatar" class="rounded-circle" width="150" height="150">
            </div>

            <!-- Upload New Avatar -->
            <div class="form-group mt-3">
                <label for="avatar">{{ __('New Avatar') }}</label>
                <input 
                    id="avatar" 
                    name="avatar" 
                    type="file" 
                    class="form-control-file {{ $errors->has('avatar') ? 'is-invalid' : '' }}"
                    accept="image/*"
                />
                @if ($errors->has('avatar'))
                    <div class="invalid-feedback">
                        {{ $errors->first('avatar') }}
                    </div>
                @endif
            </div>

            <!-- Save Button -->
            <div class="d-flex align-items-center mt-4">
                <button type="submit" class="btn shade f-primary btn-block">
                    {{ __('Save') }}
                </button>

                @if (session('status') === 'avatar-updated')
                    <p class="text-sm text-success ml-3 mb-0">
                        {{ __('Avatar updated successfully.') }}
                    </p>
                @endif
            </div>
        </form>
    </div>
</div>
