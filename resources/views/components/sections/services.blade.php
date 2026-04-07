@php
$services = \App\Models\Service::getPublished();
$stats = \App\Models\Stat::getStatsBySection('services');
@endphp

<section id="services" class="services section light-background">
    <div class="container">
        <!-- Section Title -->
        <div class="section-title" data-aos="fade-up">
            <h2>Services</h2>
            <p>{{ $settings['services_description'] ?? 'Expert solutions tailored to transform your digital presence and drive business growth' }}</p>
        </div>

        <!-- Services Grid -->
        <div class="row gy-4">
            @forelse($services as $index => $service)
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
                    <div class="service-box {{ $service->featured ? 'featured' : '' }}">
                        <i class="bi {{ $service->icon ?? 'bi-activity' }}"></i>
                        <h3>{{ $service->title }}</h3>
                        <p>{{ $service->description }}</p>
                        <a href="#contact" class="read-more"><span>Learn More</span> <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            @empty
                <!-- Default Services -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="service-box">
                        <i class="bi bi-laptop"></i>
                        <h3>Web Development</h3>
                        <p>Custom websites and web applications built with modern technologies.</p>
                        <a href="#contact" class="read-more"><span>Learn More</span> <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="service-box featured">
                        <i class="bi bi-phone"></i>
                        <h3>Mobile Apps</h3>
                        <p>Native and cross-platform mobile applications for iOS and Android.</p>
                        <a href="#contact" class="read-more"><span>Learn More</span> <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="service-box">
                        <i class="bi bi-palette"></i>
                        <h3>UI/UX Design</h3>
                        <p>Beautiful and intuitive user interfaces that delight users.</p>
                        <a href="#contact" class="read-more"><span>Learn More</span> <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="service-box">
                        <i class="bi bi-cloud"></i>
                        <h3>Cloud Solutions</h3>
                        <p>Scalable cloud infrastructure and migration services.</p>
                        <a href="#contact" class="read-more"><span>Learn More</span> <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
                    <div class="service-box">
                        <i class="bi bi-shield-check"></i>
                        <h3>Security Services</h3>
                        <p>Comprehensive cybersecurity solutions to protect your business.</p>
                        <a href="#contact" class="read-more"><span>Learn More</span> <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
                    <div class="service-box">
                        <i class="bi bi-headset"></i>
                        <h3>IT Support</h3>
                        <p>24/7 technical support and maintenance services.</p>
                        <a href="#contact" class="read-more"><span>Learn More</span> <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Stats Row -->
        @if($stats->count() > 0)
            <div class="stats-row row gy-4 justify-content-center mt-5" data-aos="fade-up" data-aos-delay="700">
                @foreach($stats->sortBy('display_order') as $stat)
                    <div class="col-6 col-md-3">
                        <div class="text-center">
                            <div class="h1 fw-bold text-primary">{{ $stat->value }}</div>
                            <div class="text-muted">{{ $stat->label }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>
