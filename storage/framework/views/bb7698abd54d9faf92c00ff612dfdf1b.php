<?php $__env->startSection('title', 'SaaSdeck | Home'); ?>

<?php $__env->startSection('content'); ?>

<!-- form -->

<div class="row ">
    <div class="col-md-5 card shade mw-center mh-center">
        <img src="<?php echo e(asset('assets/dashboard/svg/logo.svg')); ?>" alt="..." class="mw-center " height="130" width="300" >
        <hr class="hr-dashed m-0">
        <form method="POST" action="<?php echo e(route('register')); ?>">
            <?php echo csrf_field(); ?>

        <!-- Name -->
        <div class="form-group m-0">
                <label for="name"><?php echo e(__('Name')); ?></label>
            
                <input
                    type="text"
                    class="form-control <?php echo e($errors->has('name') ? 'is-invalid' : ''); ?>"
                    id="name"
                    name="name"
                    aria-describedby="nameHelp"
                    placeholder="<?php echo e(__('Enter Your Name')); ?>"
                    value="<?php echo e(old('name')); ?>"
                    required
                    autofocus
                    autocomplete="name"
                />
            
                <?php if($errors->has('name')): ?>
                    <small id="nameHelp" class="form-text text-muted">
                        <?php echo e($errors->first('name')); ?>

                    </small>
                <?php endif; ?>
        </div>

        <!-- Email Address -->
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
        
        <!-- Mobile Number -->
        <div class="form-group m-0">
                <label for="email"><?php echo e(__('Mobile Number')); ?></label>
            
                <input
                    type="text"
                    class="form-control <?php echo e($errors->has('mobile_number') ? 'is-invalid' : ''); ?>"
                    id="mobile_number"
                    name="mobile_number"
                    aria-describedby="mobile_numberHelp"
                    placeholder="+9647801234567"
                    value="<?php echo e(old('mobile_number')); ?>"
                    required
                    autofocus
                    autocomplete="mobile_number"
                />
            
                <?php if($errors->has('mobile_number')): ?>
                    <small id="mobile_numberHelp" class="form-text text-muted">
                        <?php echo e($errors->first('mobile_number')); ?>

                    </small>
                <?php endif; ?>
        </div>
        
        <!-- Domain -->
        <div class="form-group m-0">
                <label for="email"><?php echo e(__('Domain')); ?></label>
            
                <input
                    type="text"
                    class="form-control <?php echo e($errors->has('domain') ? 'is-invalid' : ''); ?>"
                    id="domain"
                    name="domain"
                    aria-describedby="domainHelp"
                    placeholder="Choose Domain Name"
                    value="<?php echo e(old('domain')); ?>"
                    required
                    autofocus
                    autocomplete="domain"
                />
            
                <?php if($errors->has('domain')): ?>
                    <small id="domainHelp" class="form-text text-muted">
                        <?php echo e($errors->first('domain')); ?>

                    </small>
                <?php endif; ?>
        </div>
        

        <!-- Password -->
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

        <!-- Confirm Password -->
        <div class="form-group m-0">
                <label for="password_confirmation"><?php echo e(__('Confirm Password')); ?></label>
            
                <input
                    type="password"
                    class="form-control <?php echo e($errors->has('password_confirmation') ? 'is-invalid' : ''); ?>"
                    id="password_confirmation"
                    name="password_confirmation"
                    placeholder="Password"
                    required
                    autocomplete="new-password"
                />
            
                <?php if($errors->has('password_confirmation')): ?>
                    <small id="passwordHelp" class="form-text text-muted">
                        <?php echo e($errors->first('password_confirmation')); ?>

                    </small>
                <?php endif; ?>
        </div>
        


            <a class="form-text text-muted" href="<?php echo e(route('login')); ?>">
                <?php echo e(__('Already registered?')); ?>

            </a>

                <button type="submit" class="btn shade f-primary btn-block"><?php echo e(__('Register')); ?></button>
        </form>
    </div>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/arajeeznet/wakeel.arajeez.net/wakeel/resources/views/auth/register.blade.php ENDPATH**/ ?>