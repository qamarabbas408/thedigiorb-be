<footer id="footer" class="footer bg-slate-900 text-white">
    <div class="container py-16">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Company Info -->
            <div>
                <a href="{{ route('home') }}" class="logo d-flex align-items-center mb-4">
                    @if($settings['logo_type'] === 'image' && $settings['logo_image'])
                        <img src="{{ $settings['logo_image'] }}" alt="{{ $settings['company_name'] }}" style="height: 50px; max-height: 50px;">
                    @else
                        <h3 class="text-xl font-bold text-white">{{ $settings['company_name'] }}</h3>
                    @endif
                </a>
                <p class="text-slate-400 mb-4">{{ $settings['company_description'] }}</p>
                <div class="social-links d-flex gap-3">
                    @if($settings['facebook_url'])
                        <a href="{{ $settings['facebook_url'] }}" class="w-10 h-10 bg-slate-800 rounded-lg flex items-center justify-center hover:bg-blue-600 transition-colors">
                            <i class="bi bi-facebook"></i>
                        </a>
                    @endif
                    @if($settings['twitter_url'])
                        <a href="{{ $settings['twitter_url'] }}" class="w-10 h-10 bg-slate-800 rounded-lg flex items-center justify-center hover:bg-blue-600 transition-colors">
                            <i class="bi bi-twitter-x"></i>
                        </a>
                    @endif
                    @if($settings['instagram_url'])
                        <a href="{{ $settings['instagram_url'] }}" class="w-10 h-10 bg-slate-800 rounded-lg flex items-center justify-center hover:bg-blue-600 transition-colors">
                            <i class="bi bi-instagram"></i>
                        </a>
                    @endif
                    @if($settings['linkedin_url'])
                        <a href="{{ $settings['linkedin_url'] }}" class="w-10 h-10 bg-slate-800 rounded-lg flex items-center justify-center hover:bg-blue-600 transition-colors">
                            <i class="bi bi-linkedin"></i>
                        </a>
                    @endif
                </div>
            </div>

            <!-- Services -->
            <div>
                <h4 class="text-lg font-semibold mb-4">Services</h4>
                <ul class="space-y-2 text-slate-400">
                    <li><a href="{{ route('home') }}#services" class="hover:text-white transition-colors">Web Development</a></li>
                    <li><a href="{{ route('home') }}#services" class="hover:text-white transition-colors">Mobile Apps</a></li>
                    <li><a href="{{ route('home') }}#services" class="hover:text-white transition-colors">UI/UX Design</a></li>
                    <li><a href="{{ route('home') }}#services" class="hover:text-white transition-colors">Custom Software</a></li>
                </ul>
            </div>

            <!-- Company -->
            <div>
                <h4 class="text-lg font-semibold mb-4">Company</h4>
                <ul class="space-y-2 text-slate-400">
                    <li><a href="{{ route('home') }}#about" class="hover:text-white transition-colors">About Us</a></li>
                    <li><a href="{{ route('home') }}#portfolio" class="hover:text-white transition-colors">Portfolio</a></li>
                    <li><a href="{{ route('home') }}#team" class="hover:text-white transition-colors">Our Team</a></li>
                    <li><a href="{{ route('home') }}#contact" class="hover:text-white transition-colors">Contact</a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div>
                <h4 class="text-lg font-semibold mb-4">Contact</h4>
                <ul class="space-y-2 text-slate-400">
                    @if($settings['company_email'])
                        <li class="flex items-center gap-2">
                            <i class="bi bi-envelope"></i>
                            <span>{{ $settings['company_email'] }}</span>
                        </li>
                    @endif
                    @if($settings['company_phone'])
                        <li class="flex items-center gap-2">
                            <i class="bi bi-telephone"></i>
                            <span>{{ $settings['company_phone'] }}</span>
                        </li>
                    @endif
                    @if($settings['company_address'])
                        <li class="flex items-center gap-2">
                            <i class="bi bi-geo-alt"></i>
                            <span>{{ $settings['company_address'] }}</span>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>

    <div class="container py-6 border-t border-slate-800">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <div class="copyright text-slate-400 text-sm">
                © <span>Copyright</span> <strong class="text-white">{{ $settings['company_name'] }}</strong>. All Rights Reserved.
            </div>
            <div class="legal-links flex gap-4 text-sm text-slate-400">
                <a href="/privacy" class="hover:text-white transition-colors">Privacy Policy</a>
                <a href="/terms" class="hover:text-white transition-colors">Terms of Service</a>
            </div>
        </div>
    </div>
</footer>
