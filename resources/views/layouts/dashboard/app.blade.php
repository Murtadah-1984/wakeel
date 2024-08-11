    <!-- Head -->
    @include('partials.dashboard.head')

    <!-- Header -->
    @include('partials.dashboard.header')

    <!-- Sidebar -->
    @include('partials.dashboard.sidebar')
    <main class="bmd-layout-content">
		<div class="container-fluid ">
			<!-- content -->
			
                <!-- BreadCrumb -->
                @include('partials.dashboard.breadcrumb')
                
                <!-- Main Content -->
                @yield('content')
                @stack('scripts')
                
        </div>
	</main>
	
    <!-- Footer -->
    @include('partials.dashboard.footer')


    
