<nav class="navbar navbar-expand-lg">
    <a class="navbar-brand" href="{{ url('/') }}">
        <img src="{{ asset('assets/dashboard/images/logo/logo.svg') }}" alt="Logo" />
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
    
    @if (Route::has('login'))
        <div class="header-btn">
            @auth
            <a href="{{ url('/dashboard') }}" class="main-btn btn-hover">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="main-btn btn-hover">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="main-btn btn-hover">Register</a>
                    @endif
                @endauth
        </div>
    @endif
</nav>