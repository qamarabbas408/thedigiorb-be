<header id="header" class="header d-flex align-items-center sticky-top bg-white shadow-sm">
    <div class="container position-relative d-flex align-items-center justify-content-between">
        <!-- Logo -->
        <a href="{{ route('home') }}" class="logo d-flex align-items-center me-auto me-xl-0">
            @if($settings['logo_type'] === 'image' && $settings['logo_image'])
                <img src="{{ $settings['logo_image'] }}" alt="{{ $settings['company_name'] }}" style="height: 50px; max-height: 50px;">
            @else
                <h1 class="sitename text-xl font-bold text-gray-800">{{ $settings['company_name'] }}</h1>
            @endif
        </a>

        <!-- Navigation -->
        <nav id="navmenu" class="navmenu">
            <ul class="flex items-center space-x-6">
                <li><a href="{{ route('home') }}#hero" class="text-gray-700 hover:text-blue-600 transition-colors">Home</a></li>
                <li><a href="{{ route('home') }}#about" class="text-gray-700 hover:text-blue-600 transition-colors">About</a></li>
                <li><a href="{{ route('home') }}#services" class="text-gray-700 hover:text-blue-600 transition-colors">Services</a></li>
                <li><a href="{{ route('home') }}#portfolio" class="text-gray-700 hover:text-blue-600 transition-colors">Portfolio</a></li>
                <li><a href="{{ route('home') }}#team" class="text-gray-700 hover:text-blue-600 transition-colors">Team</a></li>
                <li><a href="{{ route('home') }}#contact" class="text-gray-700 hover:text-blue-600 transition-colors">Contact</a></li>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list cursor-pointer text-2xl"></i>
        </nav>

        <a href="{{ route('home') }}#about" class="btn-getstarted bg-blue-600 text-white px-5 py-2 rounded-full hover:bg-blue-700 transition-colors">
            Get Started
        </a>
    </div>
</header>

<style>
    .navmenu ul {
        list-style: none;
        margin: 0;
        padding: 0;
    }
    .navmenu a.active {
        color: #2563eb !important;
    }
</style>
