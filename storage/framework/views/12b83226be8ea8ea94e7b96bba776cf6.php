<div class="py-4">
    <div class="col-md-6 card shade full-outlined o-warning">
        <header class="mt-3">
            <h2 class="text-lg font-weight-medium text-dark">
                <?php echo e(__('Update Avatar')); ?>

            </h2>

            <p class="mt-1 text-muted">
                <?php echo e(__("Upload a new avatar for your profile.")); ?>

            </p>
        </header>

        <form method="post" action="<?php echo e(route('dashboard.avatar.update')); ?>" class="mt-4">
            <?php echo csrf_field(); ?>
            <?php echo method_field('patch'); ?>

            <!-- Current Avatar Display -->
            <div class="form-group text-center">
                <img src="<?php echo e(asset('storage/' . $user->avatar)); ?>" alt="Current Avatar" class="rounded-circle" width="150" height="150">
            </div>

            <!-- Upload New Avatar -->
            <div class="form-group mt-3">
                <label for="avatar"><?php echo e(__('New Avatar')); ?></label>
                <input 
                    id="avatar" 
                    name="avatar" 
                    type="file" 
                    class="form-control-file <?php echo e($errors->has('avatar') ? 'is-invalid' : ''); ?>"
                    accept="image/*"
                />
                <?php if($errors->has('avatar')): ?>
                    <div class="invalid-feedback">
                        <?php echo e($errors->first('avatar')); ?>

                    </div>
                <?php endif; ?>
            </div>

            <!-- Save Button -->
            <div class="d-flex align-items-center mt-4">
                <button type="submit" class="btn shade f-primary btn-block">
                    <?php echo e(__('Save')); ?>

                </button>

                <?php if(session('status') === 'avatar-updated'): ?>
                    <p class="text-sm text-success ml-3 mb-0">
                        <?php echo e(__('Avatar updated successfully.')); ?>

                    </p>
                <?php endif; ?>
            </div>
        </form>
    </div>
</div>
<?php /**PATH /home/arajeeznet/wakeel.arajeez.net/wakeel/resources/views/profile/partials/update-avatar-form.blade.php ENDPATH**/ ?>