<li class="nav-item"> <img src="<?php echo e(asset('storage/' . Auth::user()->avatar)); ?>" alt="profile_picture"
							class="rounded-circle screen-user-profile"></li>
					<li class="nav-item">
						<div class="dropdown">
							<button class="btn  dropdown-toggle m-0" type="button" id="dropdownMenu4"
								data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<?php echo e(Auth::user()->name); ?>

							</button>
							<div aria-labelledby="dropdownMenu4"
     class="dropdown-menu dropdown-menu-right"
     aria-labelledby="dropdownMenu2">

    <!-- Profile Edit Link -->
    <a href="<?php echo e(route('profile.edit')); ?>" class="dropdown-item">
        <i class="far fa-user fa-sm c-main mr-2"></i>Profile
    </a>

    <!-- Dark Mode Toggle -->
    <button id="darkModeToggle" onclick="toggleDarkMode()" class="dropdown-item" type="button">
        <i class="fas fa-moon fa-sm c-main mr-2"></i>Dark Mode
    </button>

    <!-- Settings Button -->
    <a href="<?php echo e(route('profile.settings.update')); ?>" class="dropdown-item">
        <i class="fas fa-cog fa-sm c-main mr-2"></i><?php echo e(__('Settings')); ?>

    </a>


    <!-- Sign Out Form -->
    <form action="<?php echo e(route('logout')); ?>" method="POST">
        <?php echo e(csrf_field()); ?>

        <button type="submit" class="dropdown-item">
            <i class="fas fa-sign-out-alt c-main fa-sm mr-2"></i>Sign Out
        </button>
    </form>
</div>

<script>
function toggleDarkMode() {
    dark();
    const toggleButton = document.getElementById('darkModeToggle');
    
    // Check if the page is in dark mode (this logic depends on your dark mode implementation)
    const isDarkMode = document.body.classList.contains('dark-mode'); // Adjust this condition to match your dark mode logic
    
    // Toggle the dark mode on the body or root element
    document.body.classList.toggle('dark-mode', !isDarkMode); // Adjust this to fit your dark mode implementation
    
    // Change the button text
    if (isDarkMode) {
        toggleButton.innerHTML = '<i class="fas fa-moon fa-sm c-main mr-2"></i>Dark Mode';
    } else {
        toggleButton.innerHTML = '<i class="fas fa-sun fa-sm c-main mr-2"></i>Light Mode';
    }
}
</script>

						</div>
					</li><?php /**PATH /home/arajeeznet/wakeel.arajeez.net/wakeel/resources/views/partials/dashboard/avatarMenu.blade.php ENDPATH**/ ?>