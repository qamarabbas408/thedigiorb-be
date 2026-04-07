@php
$stats = \App\Models\Stat::getStatsBySection('about');
$experienceStat = $stats->firstWhere('label', fn($s) => stripos($s->label, 'years') !== false);
$projectStats = $stats->filter(fn($s) => stripos($s->label, 'years') === false);
@endphp

<section id="about" class="about section bg-gray-50">
    <div class="container py-16">
        <div class="row gy-5 align-items-center">
            <!-- Images -->
            <div class="col-xl-6" data-aos="fade-right" data-aos-delay="200">
                <div class="about-images-wrapper relative">
                    <div class="image-main mb-4">
                        <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=600&h=400&fit=crop" alt="Business meeting" class="w-full rounded-2xl shadow-xl">
                    </div>
                    <div class="image-offset absolute bottom-0 left-0 w-48 -mb-8">
                        <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?w=300&h=200&fit=crop" alt="Team collaboration" class="w-full rounded-2xl shadow-lg">
                    </div>
                    @if($experienceStat)
                        <div class="experience-badge absolute -bottom-8 right-8 bg-blue-600 text-white p-6 rounded-2xl shadow-lg">
                            <span class="block text-4xl font-bold">{{ $experienceStat->value }}</span>
                            <span class="text-sm">Years of<br>Excellence</span>
                        </div>
                    @else
                        <div class="experience-badge absolute -bottom-8 right-8 bg-blue-600 text-white p-6 rounded-2xl shadow-lg">
                            <span class="block text-4xl font-bold">12+</span>
                            <span class="text-sm">Years of<br>Excellence</span>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Content -->
            <div class="col-xl-6 mt-16 xl:mt-0" data-aos="fade-left" data-aos-delay="300">
                <div class="about-content">
                    <div class="section-subtitle text-blue-600 font-semibold mb-2">Who We Are</div>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Innovating for Your Success Through Technology</h2>
                    <p class="lead-text text-lg text-gray-600 mb-4">
                        We are a forward-thinking digital agency dedicated to transforming businesses through innovative technology solutions. Our team combines creativity with technical expertise to deliver exceptional results.
                    </p>
                    <p class="description text-gray-600 mb-6">
                        With years of experience in web development, mobile apps, and digital strategy, we help clients navigate the digital landscape with confidence.
                    </p>

                    <!-- Features Grid -->
                    <div class="features-grid grid grid-cols-2 gap-4 mb-6">
                        <div class="feature-card flex items-center gap-3 p-4 bg-white rounded-xl shadow-sm">
                            <i class="bi bi-check-circle-fill text-green-500 text-xl"></i>
                            <span class="font-medium">Fast Delivery</span>
                        </div>
                        <div class="feature-card flex items-center gap-3 p-4 bg-white rounded-xl shadow-sm">
                            <i class="bi bi-check-circle-fill text-green-500 text-xl"></i>
                            <span class="font-medium">Quality Assured</span>
                        </div>
                        <div class="feature-card flex items-center gap-3 p-4 bg-white rounded-xl shadow-sm">
                            <i class="bi bi-check-circle-fill text-green-500 text-xl"></i>
                            <span class="font-medium">Expert Team</span>
                        </div>
                        <div class="feature-card flex items-center gap-3 p-4 bg-white rounded-xl shadow-sm">
                            <i class="bi bi-check-circle-fill text-green-500 text-xl"></i>
                            <span class="font-medium">24/7 Support</span>
                        </div>
                    </div>

                    <!-- Stats Row -->
                    @if($projectStats->count() > 0)
                        <div class="stats-row flex flex-wrap gap-6 mb-8 p-6 bg-white rounded-2xl shadow-sm">
                            @foreach($projectStats->sortBy('display_order') as $stat)
                                <div class="stat-box text-center">
                                    <span class="number block text-3xl font-bold text-blue-600">{{ $stat->value }}</span>
                                    <span class="label text-sm text-gray-600">{{ $stat->label }}</span>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <!-- Action Buttons -->
                    <div class="action-buttons flex flex-wrap items-center gap-4">
                        <a href="#portfolio" class="btn btn-primary inline-flex items-center gap-2 bg-blue-600 text-white px-6 py-3 rounded-full hover:bg-blue-700 transition-colors">
                            View Our Work <i class="bi bi-arrow-right"></i>
                        </a>
                        <div class="contact-info flex items-center gap-3">
                            <div class="icon-box w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center text-blue-600">
                                <i class="bi bi-telephone-fill"></i>
                            </div>
                            <div class="text">
                                <span class="block text-sm text-gray-500">Call Us Today</span>
                                <a href="tel:{{ str_replace(' ', '', $settings['company_phone'] ?? '') }}" class="font-medium text-gray-900 hover:text-blue-600">
                                    {{ $settings['company_phone'] ?? '' }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
