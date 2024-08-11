    <!-- Head -->
    <?php echo $__env->make('partials.dashboard.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- Header -->
    <?php echo $__env->make('partials.dashboard.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- Sidebar -->
    <?php echo $__env->make('partials.dashboard.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <main class="bmd-layout-content">
		<div class="container-fluid ">
			<!-- content -->
			
                <!-- BreadCrumb -->
                <?php echo $__env->make('partials.dashboard.breadcrumb', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                
                <!-- Main Content -->
                <?php echo $__env->yieldContent('content'); ?>
                <?php echo $__env->yieldPushContent('scripts'); ?>
                
        </div>
	</main>
	
    <!-- Footer -->
    <?php echo $__env->make('partials.dashboard.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


    
<?php /**PATH /home/arajeeznet/wakeel.arajeez.net/wakeel/resources/views/layouts/dashboard/app.blade.php ENDPATH**/ ?>