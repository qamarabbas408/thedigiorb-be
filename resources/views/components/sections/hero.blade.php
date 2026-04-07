@php
$stats = \App\Models\Stat::getStatsBySection('hero');
@endphp

<section id="hero" class="hero section">
    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row align-items-center gy-5">
            <div class="col-lg-6" data-aos="fade-right" data-aos-delay="200">
                <div class="hero-content">
                    <div class="hero-tag" data-aos="fade-up" data-aos-delay="250">
                        <span class="tag-dot"></span>
                        <span class="tag-text">Premium Digital Solutions</span>
                    </div>
                    <h1 class="hero-headline" data-aos="fade-up" data-aos-delay="300">
                        {{ $settings['hero_title'] ?? 'Crafting Exceptional Digital Experiences' }}
                    </h1>
                    <p class="hero-text" data-aos="fade-up" data-aos-delay="350">
                        {{ $settings['hero_subtitle'] ?? 'We build innovative digital solutions that help businesses grow. From web development to mobile apps, we bring your vision to life.' }}
                    </p>
                    <div class="hero-cta" data-aos="fade-up" data-aos-delay="400">
                        <a href="#services" class="cta-button">
                            <span>Explore Services</span>
                            <i class="bi bi-arrow-right"></i>
                        </a>
                        <a href="{{ $settings['hero_video_url'] ?? '#' }}" class="glightbox cta-link" data-gallery="hero-video">
                            <i class="bi bi-play-circle"></i>
                            <span>Watch Video</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left" data-aos-delay="300">
                <div class="stats-grid">
                    @if($stats->count() > 0)
                        @foreach($stats->sortBy('display_order') as $index => $stat)
                            <div class="stat-card {{ $index === 0 ? 'stat-card-primary' : ($index === 3 ? 'stat-card-accent' : '') }}" data-aos="zoom-in" data-aos-delay="{{ 350 + ($index * 50) }}">
                                <div class="stat-icon-wrap">
                                    <i class="bi {{ $stat->icon ?? 'bi-graph-up' }}"></i>
                                </div>
                                <div class="stat-info">
                                    <span class="stat-value">{{ $stat->value }}</span>
                                    <span class="stat-title">{{ $stat->label }}</span>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="stat-card stat-card-primary" data-aos="zoom-in" data-aos-delay="350">
                            <div class="stat-icon-wrap">
                                <i class="bi bi-rocket-takeoff"></i>
                            </div>
                            <div class="stat-info">
                                <span class="stat-value">150+</span>
                                <span class="stat-title">Projects Launched</span>
                            </div>
                        </div>
                        <div class="stat-card" data-aos="zoom-in" data-aos-delay="400">
                            <div class="stat-icon-wrap">
                                <i class="bi bi-heart"></i>
                            </div>
                            <div class="stat-info">
                                <span class="stat-value">98%</span>
                                <span class="stat-title">Client Satisfaction</span>
                            </div>
                        </div>
                        <div class="stat-card" data-aos="zoom-in" data-aos-delay="450">
                            <div class="stat-icon-wrap">
                                <i class="bi bi-lightbulb"></i>
                            </div>
                            <div class="stat-info">
                                <span class="stat-value">12+</span>
                                <span class="stat-title">Years Experience</span>
                            </div>
                        </div>
                        <div class="stat-card stat-card-accent" data-aos="zoom-in" data-aos-delay="500">
                            <div class="stat-icon-wrap">
                                <i class="bi bi-briefcase"></i>
                            </div>
                            <div class="stat-info">
                                <span class="stat-value">40+</span>
                                <span class="stat-title">Team Experts</span>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
