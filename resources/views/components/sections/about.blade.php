@php
$stats = \App\Models\Stat::getStatsBySection('about');
$experienceStat = $stats->firstWhere('label', fn($s) => stripos($s->label, 'years') !== false);
$projectStats = $stats->filter(fn($s) => stripos($s->label, 'years') === false);
@endphp

<section id="about" class="about section">
    <div class="container" data-aos="fade-up">
        <div class="row gy-4 align-items-center">
            <!-- Images -->
            <div class="col-lg-6" data-aos="fade-right" data-aos-delay="100">
                <div class="row position-relative">
                    <div class="col-lg-7">
                        <img src="{{ $settings['about_image_1'] ?? 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=600' }}" alt="About" class="img-fluid rounded">
                    </div>
                    <div class="col-lg-5 about-images">
                        @if($experienceStat)
                            <div class="img-fluid rounded bg-primary text-center py-5 text-white position-relative">
                                <div class="Counter-Value h1" data-TO="10">{{ $experienceStat->value }}</div>
                                <div>Years Experience</div>
                            </div>
                        @else
                            <div class="img-fluid rounded bg-primary text-center py-5 text-white position-relative">
                                <div class="Counter-Value h1" data-TO="12">12+</div>
                                <div>Years Experience</div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="col-lg-6" data-aos="fade-left" data-aos-delay="200">
                <div class="about-content">
                    <h2>{{ $settings['about_title'] ?? 'Innovating for Your Success Through Technology' }}</h2>
                    <p>{{ $settings['about_description'] ?? 'We are a forward-thinking digital agency dedicated to transforming businesses through innovative technology solutions.' }}</p>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <ul class="list-unstyled">
                            <li class="d-flex align-items-center mb-3">
                                <i class="bi bi-check-circle text-primary me-2 fs-5"></i>
                                <span>Fast Delivery</span>
                            </li>
                            <li class="d-flex align-items-center mb-3">
                                <i class="bi bi-check-circle text-primary me-2 fs-5"></i>
                                <span>Quality Assured</span>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul class="list-unstyled">
                            <li class="d-flex align-items-center mb-3">
                                <i class="bi bi-check-circle text-primary me-2 fs-5"></i>
                                <span>Expert Team</span>
                            </li>
                            <li class="d-flex align-items-center mb-3">
                                <i class="bi bi-check-circle text-primary me-2 fs-5"></i>
                                <span>24/7 Support</span>
                            </li>
                        </ul>
                    </div>
                </div>
                @if($projectStats->count() > 0)
                    <div class="row mt-4">
                        @foreach($projectStats->sortBy('display_order') as $stat)
                            <div class="col-4 text-center">
                                <div class="h2 mb-0 text-primary fw-bold">{{ $stat->value }}</div>
                                <div class="small text-muted">{{ $stat->label }}</div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
