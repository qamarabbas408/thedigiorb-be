@php
$services = \App\Models\Service::getPublished();
$stats = \App\Models\Stat::getStatsBySection('services');
$featuredServices = $services->filter(fn($s) => $s->featured);
$regularServices = $services->filter(fn($s) => !$s->featured);
@endphp

<section id="services" class="services section">
    <div class="container py-16">
        <!-- Section Title -->
        <div class="section-title text-center mb-12" data-aos="fade-up">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Services</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">Expert solutions tailored to transform your digital presence and drive business growth</p>
        </div>

        <!-- Services Grid -->
        <div class="row g-4 mb-16" data-aos="fade-up" data-aos-delay="100">
            @forelse($services as $index => $service)
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
                    <div class="service-card relative p-6 bg-white rounded-2xl shadow-lg hover:shadow-xl transition-shadow h-full {{ $service->featured ? 'border-2 border-blue-600' : '' }}">
                        @if($service->featured)
                            <div class="featured-badge absolute -top-3 left-4 bg-blue-600 text-white text-xs font-semibold px-3 py-1 rounded-full flex items-center gap-1">
                                <i class="bi bi-star-fill"></i> Popular
                            </div>
                        @endif
                        <div class="icon-wrapper w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center mb-4 text-blue-600">
                            <i class="bi {{ $service->icon ?? 'bi-grid-1x2' }} text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $service->title }}</h3>
                        <p class="text-gray-600 mb-4">{{ $service->description }}</p>
                        <a href="#contact" class="service-link inline-flex items-center gap-2 text-blue-600 font-medium hover:text-blue-700">
                            <span>Discover More</span>
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            @empty
                <!-- Default Services -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="service-card relative p-6 bg-white rounded-2xl shadow-lg hover:shadow-xl transition-shadow h-full">
                        <div class="icon-wrapper w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center mb-4 text-blue-600">
                            <i class="bi bi-laptop text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Web Development</h3>
                        <p class="text-gray-600 mb-4">Custom websites and web applications built with modern technologies.</p>
                        <a href="#contact" class="service-link inline-flex items-center gap-2 text-blue-600 font-medium hover:text-blue-700">
                            <span>Discover More</span>
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="service-card relative p-6 bg-white rounded-2xl shadow-lg hover:shadow-xl transition-shadow h-full border-2 border-blue-600">
                        <div class="featured-badge absolute -top-3 left-4 bg-blue-600 text-white text-xs font-semibold px-3 py-1 rounded-full flex items-center gap-1">
                            <i class="bi bi-star-fill"></i> Popular
                        </div>
                        <div class="icon-wrapper w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center mb-4 text-blue-600">
                            <i class="bi bi-phone text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Mobile Apps</h3>
                        <p class="text-gray-600 mb-4">Native and cross-platform mobile applications for iOS and Android.</p>
                        <a href="#contact" class="service-link inline-flex items-center gap-2 text-blue-600 font-medium hover:text-blue-700">
                            <span>Discover More</span>
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="service-card relative p-6 bg-white rounded-2xl shadow-lg hover:shadow-xl transition-shadow h-full">
                        <div class="icon-wrapper w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center mb-4 text-blue-600">
                            <i class="bi bi-palette text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">UI/UX Design</h3>
                        <p class="text-gray-600 mb-4">Beautiful and intuitive user interfaces that delight users.</p>
                        <a href="#contact" class="service-link inline-flex items-center gap-2 text-blue-600 font-medium hover:text-blue-700">
                            <span>Discover More</span>
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Stats Row -->
        <div class="stats-row bg-gradient-to-r from-slate-800 to-slate-900 rounded-2xl p-8 md:p-12" data-aos="fade-up" data-aos-delay="400">
            <div class="row g-4 justify-content-center">
                @if($stats->count() > 0)
                    @foreach($stats->sortBy('display_order') as $stat)
                        <div class="col-6 col-md-3">
                            <div class="stat-item text-center">
                                <span class="stat-number block text-4xl font-bold text-white mb-2">{{ $stat->value }}</span>
                                <span class="stat-label text-slate-400">{{ $stat->label }}</span>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-6 col-md-3">
                        <div class="stat-item text-center">
                            <span class="stat-number block text-4xl font-bold text-white mb-2">250+</span>
                            <span class="stat-label text-slate-400">Projects Delivered</span>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="stat-item text-center">
                            <span class="stat-number block text-4xl font-bold text-white mb-2">98%</span>
                            <span class="stat-label text-slate-400">Client Satisfaction</span>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="stat-item text-center">
                            <span class="stat-number block text-4xl font-bold text-white mb-2">15+</span>
                            <span class="stat-label text-slate-400">Years Experience</span>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="stat-item text-center">
                            <span class="stat-number block text-4xl font-bold text-white mb-2">40+</span>
                            <span class="stat-label text-slate-400">Team Experts</span>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
