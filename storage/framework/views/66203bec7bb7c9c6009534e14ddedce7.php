<div class="py-4">
    <div class="col-md-6 card shade full-outlined o-warning">
        <header class="mt-3">
            <h2 class="text-lg font-weight-medium text-dark">
                <?php echo e(__('Profile Information')); ?>

            </h2>

            <p class="mt-1 text-muted">
                <?php echo e(__("Update your account's profile information and email address.")); ?>

            </p>
        </header>

        <form id="send-verification" method="post" action="<?php echo e(route('verification.send')); ?>">
            <?php echo csrf_field(); ?>
        </form>

        <form method="post" action="<?php echo e(route('profile-dash-update')); ?>" class="mt-4">
            <?php echo csrf_field(); ?>
            <?php echo method_field('patch'); ?>

            <!-- Name -->
            <div class="form-group">
                <label for="name"><?php echo e(__('Name')); ?></label>
                <input 
                    id="name" 
                    name="name" 
                    type="text" 
                    class="form-control <?php echo e($errors->has('name') ? 'is-invalid' : ''); ?>" 
                    value="<?php echo e(old('name', $user->name)); ?>" 
                    required 
                    autofocus 
                    autocomplete="name"
                />
                <?php if($errors->has('name')): ?>
                    <div class="invalid-feedback">
                        <?php echo e($errors->first('name')); ?>

                    </div>
                <?php endif; ?>
            </div>

            <!-- Email -->
            <div class="form-group mt-3">
                <label for="email"><?php echo e(__('Email')); ?></label>
                <input 
                    id="email" 
                    name="email" 
                    type="email" 
                    class="form-control <?php echo e($errors->has('email') ? 'is-invalid' : ''); ?>" 
                    value="<?php echo e(old('email', $user->email)); ?>" 
                    required 
                    autocomplete="username"
                />
                <?php if($errors->has('email')): ?>
                    <div class="invalid-feedback">
                        <?php echo e($errors->first('email')); ?>

                    </div>
                <?php endif; ?>

                <?php if($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail()): ?>
                    <div class="mt-2">
                        <p class="text-sm text-dark">
                            <?php echo e(__('Your email address is unverified.')); ?>


                            <button 
                                form="send-verification" 
                                class="btn btn-link p-0 align-baseline text-sm text-primary"
                            >
                                <?php echo e(__('Click here to re-send the verification email.')); ?>

                            </button>
                        </p>

                        <?php if(session('status') === 'verification-link-sent'): ?>
                            <p class="mt-2 font-medium text-sm text-success">
                                <?php echo e(__('A new verification link has been sent to your email address.')); ?>

                            </p>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Save Button -->
            <div class="d-flex align-items-center mt-4">
                <button type="submit" class="btn shade f-primary">
                    <?php echo e(__('Save')); ?>

                </button>

                <?php if(session('status') === 'profile-updated'): ?>
                    <p class="text-sm text-success ml-3 mb-0">
                        <?php echo e(__('Saved.')); ?>

                    </p>
                <?php endif; ?>
            </div>
        </form>
    </div>
</div>
<?php /**PATH /home/arajeeznet/wakeel.arajeez.net/wakeel/resources/views/profile/partials/update-profile-information-form.blade.php ENDPATH**/ ?>