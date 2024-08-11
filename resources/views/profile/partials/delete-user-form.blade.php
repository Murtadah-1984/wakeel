<div class="py-4">
    <div class="col-md-6 card shade full-outlined o-warning">
        <header class="mt-3">
            <h2 class="text-lg font-weight-medium text-dark">
                {{ __('Delete Account') }}
            </h2>

            <p class="mt-1 text-muted">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
            </p>
        </header>

        <!-- Delete Account Button -->
        <button
            class="btn btn-danger mt-3 mb-3"
            type="button"
            data-toggle="modal"
            data-target="#confirmUserDeletionModal"
        >
            {{ __('Delete Account') }}
        </button>

        <!-- Confirm User Deletion Modal -->
        <div class="modal fade" id="confirmUserDeletionModal" tabindex="-1" aria-labelledby="confirmUserDeletionLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmUserDeletionLabel">{{ __('Are you sure you want to delete your account?') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>{{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}</p>
                        <form method="post" action="{{ route('profile.dashboard.destroy') }}">
                            @csrf
                            @method('delete')

                            <!-- Password Input -->
                            <div class="form-group">
                                <label for="password" class="sr-only">{{ __('Password') }}</label>
                                <input
                                    id="password"
                                    name="password"
                                    type="password"
                                    class="form-control {{ $errors->userDeletion->has('password') ? 'is-invalid' : '' }}"
                                    placeholder="{{ __('Password') }}"
                                    required
                                />
                                @if ($errors->userDeletion->has('password'))
                                    <div class="invalid-feedback">
                                        {{ $errors->userDeletion->first('password') }}
                                    </div>
                                @endif
                            </div>

                            <!-- Modal Footer with Cancel and Delete Buttons -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Cancel') }}</button>
                                <button type="submit" class="btn btn-danger">{{ __('Delete Account') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
