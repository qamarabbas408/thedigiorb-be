@php
$stats = \App\Models\Stat::getStatsBySection('hero');
@endphp

<section id="hero" class="hero section">
    <div class="container py-20" data-aos="fade-up" data-aos-delay="100">
        <div class="row align-items-center gy-5">
            <!-- Left Content -->
            <div class="col-lg-6" data-aos="fade-right" data-aos-delay="200">
                <div class="hero-content">
                    <div class="hero-tag flex items-center gap-2 mb-4" data-aos="fade-up" data-aos-delay="250">
                        <span class="w-2 h-2 bg-blue-600 rounded-full"></span>
                        <span class="text-sm font-medium text-gray-600">Premium Digital Solutions</span>
                    </div>
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-6 leading-tight" data-aos="fade-up" data-aos-delay="300">
                        Crafting Exceptional<br>Digital Experiences
                    </h1>
                    <p class="text-lg text-gray-600 mb-8 max-w-xl" data-aos="fade-up" data-aos-delay="350">
                        We build innovative digital solutions that help businesses grow. From web development to mobile apps, we bring your vision to life.
                    </p>
                    <div class="hero-cta flex flex-wrap gap-4" data-aos="fade-up" data-aos-delay="400">
                        <a href="#services" class="cta-button inline-flex items-center gap-2 bg-blue-600 text-white px-6 py-3 rounded-full hover:bg-blue-700 transition-colors">
                            <span>Explore Services</span>
                            <i class="bi bi-arrow-right"></i>
                        </a>
                        <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8" class="cta-link inline-flex items-center gap-2 text-gray-700 hover:text-blue-600 transition-colors">
                            <i class="bi bi-play-circle text-xl"></i>
                            <span>Watch Video</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Right Stats -->
            <div class="col-lg-6" data-aos="fade-left" data-aos-delay="300">
                <div class="stats-grid grid grid-cols-2 gap-4">
                    @if($stats->count() > 0)
                        @foreach($stats->sortBy('display_order') as $index => $stat)
                            <div class="stat-card p-6 bg-white rounded-2xl shadow-lg hover:shadow-xl transition-shadow {{ $index === 0 ? 'bg-blue-600 text-white' : ($index === 3 ? 'bg-amber-500 text-white' : '') }}" data-aos="zoom-in" data-aos-delay="{{ 350 + ($index * 50) }}">
                                <div class="stat-icon-wrap text-3xl mb-3">
                                    <i class="bi {{ $stat->icon ?? 'bi-graph-up' }}"></i>
                                </div>
                                <div class="stat-info">
                                    <span class="stat-value block text-3xl font-bold mb-1">{{ $stat->value }}</span>
                                    <span class="stat-title text-sm opacity-80">{{ $stat->label }}</span>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <!-- Default Stats -->
                        <div class="stat-card p-6 bg-blue-600 text-white rounded-2xl shadow-lg" data-aos="zoom-in" data-aos-delay="350">
                            <div class="text-3xl mb-3"><i class="bi bi-rocket-takeoff"></i></div>
                            <span class="block text-3xl font-bold mb-1">150+</span>
                            <span class="text-sm opacity-80">Projects Launched</span>
                        </div>
                        <div class="stat-card p-6 bg-white rounded-2xl shadow-lg hover:shadow-xl transition-shadow" data-aos="zoom-in" data-aos-delay="400">
                            <div class="text-3xl mb-3 text-pink-500"><i class="bi bi-heart"></i></div>
                            <span class="block text-3xl font-bold mb-1 text-gray-900">98%</span>
                            <span class="text-sm text-gray-600">Client Satisfaction</span>
                        </div>
                        <div class="stat-card p-6 bg-white rounded-2xl shadow-lg hover:shadow-xl transition-shadow" data-aos="zoom-in" data-aos-delay="450">
                            <div class="text-3xl mb-3 text-amber-500"><i class="bi bi-lightbulb"></i></div>
                            <span class="block text-3xl font-bold mb-1 text-gray-900">12+</span>
                            <span class="text-sm text-gray-600">Years Experience</span>
                        </div>
                        <div class="stat-card p-6 bg-amber-500 text-white rounded-2xl shadow-lg" data-aos="zoom-in" data-aos-delay="500">
                            <div class="text-3xl mb-3"><i class="bi bi-briefcase"></i></div>
                            <span class="block text-3xl font-bold mb-1">40+</span>
                            <span class="text-sm opacity-80">Team Experts</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
