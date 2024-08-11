<nav class="navbar navbar-expand-lg">
    <a class="navbar-brand" href="<?php echo e(url('/')); ?>">
        <img src="<?php echo e(asset('assets/dashboard/images/logo/logo.svg')); ?>" alt="Logo" />
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="toggler-icon"></span>
        <span class="toggler-icon"></span>
        <span class="toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
        <div class="ms-auto">
            <ul id="nav" class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="page-scroll active" href="#home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="page-scroll" href="#features">Features</a>
                </li>
                <li class="nav-item">
                    <a class="page-scroll" href="#testimonial">Testimonial</a>
                </li>
                <li class="nav-item">
                    <a class="page-scroll" href="#pricing">Pricing</a>
                </li>
                <li class="nav-item">
                    <a class="page-scroll" href="#team">Team</a>
                </li>
            </ul>
        </div>
    </div>
    
    <?php if(Route::has('login')): ?>
        <div class="header-btn">
            <?php if(auth()->guard()->check()): ?>
            <a href="<?php echo e(url('/dashboard')); ?>" class="main-btn btn-hover">Dashboard</a>
            <?php else: ?>
                <a href="<?php echo e(route('login')); ?>" class="main-btn btn-hover">Log in</a>
                    <?php if(Route::has('register')): ?>
                        <a href="<?php echo e(route('register')); ?>" class="main-btn btn-hover">Register</a>
                    <?php endif; ?>
                <?php endif; ?>
        </div>
    <?php endif; ?>
</nav><?php /**PATH /home/arajeeznet/wakeel.arajeez.net/wakeel/resources/views/partials/home/nav.blade.php ENDPATH**/ ?>