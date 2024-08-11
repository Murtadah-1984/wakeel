<!DOCTYPE html>
<html class="no-js" lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title><?php echo $__env->yieldContent('title', 'SaaSdeck | Bootstrap 5 SaaS Landing Page'); ?></title>
    <meta name="description" content="<?php echo $__env->yieldContent('description', ''); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo e(asset('assets/images/favicon.svg')); ?>"/>
    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>

    <!-- CSS here -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/bootstrap-5.0.0-beta2.min.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/LineIcons.2.0.css')); ?>"/>
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/tiny-slider.css')); ?>"/>
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/animate.css')); ?>"/>
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/main.css')); ?>"/>

    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>
    <!--[if lte IE 9]>
      <p class="browserupgrade">
        You are using an <strong>outdated</strong> browser. Please
        <a href="https://browsehappy.com/">upgrade your browser</a> to improve
        your experience and security.
      </p>
    <![endif]-->

    <!-- Preloader -->
    <?php echo $__env->make('partials.home.preloader', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- Header -->
    <?php echo $__env->make('partials.home.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- Main Content -->
    <?php echo $__env->yieldContent('content'); ?>

    <!-- Footer -->
    <?php echo $__env->make('partials.home.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- Scroll Top Button -->
    <a href="#" class="scroll-top btn-hover">
      <i class="lni lni-chevron-up"></i>
    </a>
    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>

    <!-- JavaScript -->
    <script src="<?php echo e(asset('assets/js/bootstrap-5.0.0-beta2.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/tiny-slider.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/wow.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/polyfill.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/main.js')); ?>"></script>

    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html><?php /**PATH /home/arajeeznet/wakeel.arajeez.net/wakeel/resources/views/layouts/home/app.blade.php ENDPATH**/ ?>