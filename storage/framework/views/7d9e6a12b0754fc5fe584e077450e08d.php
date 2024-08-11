<?php $__env->startSection('title', 'SaaSdeck | Home'); ?>

<?php $__env->startSection('content'); ?>

					
<!-- form -->

<div class="row ">
    <div class="col-md-5 card shade mw-center mh-center">
        <img src="<?php echo e(asset('assets/dashboard/svg/logo.svg')); ?>" alt="..." class="mw-center " height="130" width="300" >
        <hr class="hr-dashed m-0">
        <form method="POST" action="<?php echo e(route('login')); ?>" >
             <?php echo csrf_field(); ?>
            <div class="form-group m-0">
                <label for="email"><?php echo e(__('Email')); ?></label>
            
                <input
                    type="email"
                    class="form-control <?php echo e($errors->has('email') ? 'is-invalid' : ''); ?>"
                    id="email"
                    name="email"
                    aria-describedby="emailHelp"
                    placeholder="Enter email"
                    value="<?php echo e(old('email')); ?>"
                    required
                    autofocus
                    autocomplete="username"
                />
            
                <?php if($errors->has('email')): ?>
                    <small id="emailHelp" class="form-text text-muted">
                        <?php echo e($errors->first('email')); ?>

                    </small>
                <?php endif; ?>
            </div>

            <div class="form-group m-0">
                <label for="password"><?php echo e(__('Password')); ?></label>
            
                <input
                    type="password"
                    class="form-control <?php echo e($errors->has('password') ? 'is-invalid' : ''); ?>"
                    id="password"
                    name="password"
                    placeholder="Password"
                    required
                    autocomplete="current-password"
                />
            
                <?php if($errors->has('password')): ?>
                    <small id="passwordHelp" class="form-text text-muted">
                        <?php echo e($errors->first('password')); ?>

                    </small>
                <?php endif; ?>
            </div>

            <div class="form-check pt-2">
                <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
                <label class="form-check-label" for="remember_me"><?php echo e(__('Remember me')); ?></label>
            </div>
            <button type="submit" class="btn shade f-primary btn-block"><?php echo e(__('Log in')); ?></button>
        </form>
    </div>

</div>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/arajeeznet/wakeel.arajeez.net/wakeel/resources/views/auth/login.blade.php ENDPATH**/ ?>