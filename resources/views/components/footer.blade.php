<footer id="footer" class="footer dark-background">
    <div class="container footer-top">
        <div class="row gy-4">
            <!-- Company Info -->
            <div class="col-lg-4 col-md-6 footer-about">
                <a href="{{ route('home') }}" class="logo d-flex align-items-center">
                    @if($settings['logo_type'] === 'image' && $settings['logo_image'])
                        <img src="{{ $settings['logo_image'] }}" alt="{{ $settings['company_name'] }}">
                    @else
                        <h3 class="sitename">{{ $settings['company_name'] }}</h3>
                    @endif
                </a>
                <div class="footer-contact pt-3">
                    <p>{{ $settings['company_description'] }}</p>
                    <div class="social-links d-flex mt-4">
                        @if($settings['facebook_url'])
                            <a href="{{ $settings['facebook_url'] }}"><i class="bi bi-facebook"></i></a>
                        @endif
                        @if($settings['twitter_url'])
                            <a href="{{ $settings['twitter_url'] }}"><i class="bi bi-twitter-x"></i></a>
                        @endif
                        @if($settings['instagram_url'])
                            <a href="{{ $settings['instagram_url'] }}"><i class="bi bi-instagram"></i></a>
                        @endif
                        @if($settings['linkedin_url'])
                            <a href="{{ $settings['linkedin_url'] }}"><i class="bi bi-linkedin"></i></a>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Useful Links -->
            <div class="col-lg-2 col-md-3 footer-links">
                <h4>Useful Links</h4>
                <ul>
                    <li><i class="bi bi-chevron-right"></i> <a href="{{ route('home') }}#hero">Home</a></li>
                    <li><i class="bi bi-chevron-right"></i> <a href="{{ route('home') }}#about">About us</a></li>
                    <li><i class="bi bi-chevron-right"></i> <a href="{{ route('home') }}#services">Services</a></li>
                    <li><i class="bi bi-chevron-right"></i> <a href="{{ route('home') }}#portfolio">Portfolio</a></li>
                    <li><i class="bi bi-chevron-right"></i> <a href="{{ route('home') }}#team">Team</a></li>
                </ul>
            </div>

            <!-- Services -->
            <div class="col-lg-2 col-md-3 footer-links">
                <h4>Our Services</h4>
                <ul>
                    <li><i class="bi bi-chevron-right"></i> <a href="{{ route('home') }}#services">Web Development</a></li>
                    <li><i class="bi bi-chevron-right"></i> <a href="{{ route('home') }}#services">Mobile Apps</a></li>
                    <li><i class="bi bi-chevron-right"></i> <a href="{{ route('home') }}#services">UI/UX Design</a></li>
                    <li><i class="bi bi-chevron-right"></i> <a href="{{ route('home') }}#services">Custom Software</a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div class="col-lg-2 col-md-3 footer-links">
                <h4>Contact</h4>
                <ul>
                    @if($settings['company_email'])
                        <li><i class="bi bi-envelope"></i> {{ $settings['company_email'] }}</li>
                    @endif
                    @if($settings['company_phone'])
                        <li><i class="bi bi-phone"></i> {{ $settings['company_phone'] }}</li>
                    @endif
                    @if($settings['company_address'])
                        <li><i class="bi bi-geo-alt"></i> {{ $settings['company_address'] }}</li>
                    @endif
                </ul>
            </div>
        </div>
    </div>

    <div class="container copyright text-center">
        <p>© <span>Copyright</span> <strong class="px-1 sitename">{{ $settings['company_name'] }}</strong> <span>All Rights Reserved</span></p>
        <div class="credits">
            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
    </div>
</footer>
