<header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container position-relative d-flex align-items-center justify-content-between">
        <a href="{{ route('home') }}" class="logo d-flex align-items-center me-auto me-xl-0">
            @if($settings['logo_type'] === 'image' && $settings['logo_image'])
                <img src="{{ $settings['logo_image'] }}" alt="{{ $settings['company_name'] }}" style="height: 50px; max-height: 50px;">
            @else
                <h1 class="sitename">{{ $settings['company_name'] }}</h1>
            @endif
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="{{ route('home') }}#hero" class="active">Home</a></li>
                <li><a href="{{ route('home') }}#about">About</a></li>
                <li><a href="{{ route('home') }}#services">Services</a></li>
                <li><a href="{{ route('home') }}#portfolio">Portfolio</a></li>
                <li><a href="{{ route('home') }}#team">Team</a></li>
                <li><a href="{{ route('home') }}#contact">Contact</a></li>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        <a class="btn-getstarted" href="{{ route('home') }}#about">Get Started</a>
    </div>
</header>

<style>
    .navmenu ul li a {
        text-decoration: none !important;
    }
    .navmenu ul li a:hover {
        text-decoration: none !important;
    }
</style>
