<?php $__env->startSection('content'); ?>


<div class="container mt-5">
    <h2 class="font-weight-semibold text-dark display-4">
        <?php echo e(__('Profile')); ?>

    </h2>

    <div class="row">
        <div class="justify-content-center">
            
                <!-- Update Avatar Form -->
                <?php echo $__env->make('profile.partials.update-avatar-form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            

                <!-- Update Profile Information Form -->
                <?php echo $__env->make('profile.partials.update-profile-information-form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


                <!-- Update Password Form -->
                <?php echo $__env->make('profile.partials.update-password-form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


                <!-- Delete User Form -->
                <?php echo $__env->make('profile.partials.delete-user-form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>
</div>





<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/arajeeznet/wakeel.arajeez.net/wakeel/resources/views/profile/edit.blade.php ENDPATH**/ ?>