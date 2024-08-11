<div class="py-4">
    <div class="col-md-6 card shade full-outlined o-warning">
        <header class="mt-3">
            <h2 class="text-lg font-weight-medium text-dark">
                <?php echo e(__('Update Password')); ?>

            </h2>

            <p class="mt-1 text-muted">
                <?php echo e(__('Ensure your account is using a long, random password to stay secure.')); ?>

            </p>
        </header>

        <form method="post" action="<?php echo e(route('profile-dash-update')); ?>" class="mt-4">
            <?php echo csrf_field(); ?>
            <?php echo method_field('put'); ?>

            <!-- Current Password -->
            <div class="form-group">
                <label for="update_password_current_password"><?php echo e(__('Current Password')); ?></label>
                <input
                    id="update_password_current_password"
                    name="current_password"
                    type="password"
                    class="form-control <?php echo e($errors->updatePassword->has('current_password') ? 'is-invalid' : ''); ?>"
                    autocomplete="current-password"
                />
                <?php if($errors->updatePassword->has('current_password')): ?>
                    <div class="invalid-feedback">
                        <?php echo e($errors->updatePassword->first('current_password')); ?>

                    </div>
                <?php endif; ?>
            </div>

            <!-- New Password -->
            <div class="form-group mt-3">
                <label for="update_password_password"><?php echo e(__('New Password')); ?></label>
                <input
                    id="update_password_password"
                    name="password"
                    type="password"
                    class="form-control <?php echo e($errors->updatePassword->has('password') ? 'is-invalid' : ''); ?>"
                    autocomplete="new-password"
                />
                <?php if($errors->updatePassword->has('password')): ?>
                    <div class="invalid-feedback">
                        <?php echo e($errors->updatePassword->first('password')); ?>

                    </div>
                <?php endif; ?>
            </div>

            <!-- Confirm Password -->
            <div class="form-group mt-3">
                <label for="update_password_password_confirmation"><?php echo e(__('Confirm Password')); ?></label>
                <input
                    id="update_password_password_confirmation"
                    name="password_confirmation"
                    type="password"
                    class="form-control <?php echo e($errors->updatePassword->has('password_confirmation') ? 'is-invalid' : ''); ?>"
                    autocomplete="new-password"
                />
                <?php if($errors->updatePassword->has('password_confirmation')): ?>
                    <div class="invalid-feedback">
                        <?php echo e($errors->updatePassword->first('password_confirmation')); ?>

                    </div>
                <?php endif; ?>
            </div>

            <!-- Save Button -->
            <div class="d-flex align-items-center mt-4">
                <button type="submit" class="btn shade f-primary">
                    <?php echo e(__('Save')); ?>

                </button>

                <?php if(session('status') === 'password-updated'): ?>
                    <p class="text-sm text-success ml-3 mb-0">
                        <?php echo e(__('Saved.')); ?>

                    </p>
                <?php endif; ?>
            </div>
        </form>
    </div>
</div>
<?php /**PATH /home/arajeeznet/wakeel.arajeez.net/wakeel/resources/views/profile/partials/update-password-form.blade.php ENDPATH**/ ?>