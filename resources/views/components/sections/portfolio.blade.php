@php
$projects = \App\Models\Project::getPublished();
$categories = \App\Models\Category::orderBy('display_order')->get();
@endphp

<section id="portfolio" class="portfolio section">
    <div class="container">
        <div class="section-title" data-aos="fade-up">
            <h2>Portfolio</h2>
            <p>{{ $settings['portfolio_description'] ?? 'Our Work & Projects' }}</p>
        </div>

        <div class="row gy-4" data-aos="fade-up" data-aos-delay="100">
            @forelse($projects as $project)
                <div class="col-lg-4 col-md-6">
                    <div class="portfolio-item">
                        <div class="portfolio-img">
                            <img src="{{ $project->image ?? 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=600' }}" class="img-fluid" alt="{{ $project->title }}">
                        </div>
                        <div class="portfolio-info">
                            <h4>{{ $project->title }}</h4>
                            @if($project->category)
                                <p>{{ $project->category->name }}</p>
                            @endif
                            <a href="{{ $project->image ?? '#' }}" class="glightbox preview-link" title="{{ $project->title }}"><i class="bi bi-zoom-in"></i></a>
                            <a href="#contact" class="details-link" title="More Details"><i class="bi bi-link-45deg"></i></a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <i class="bi bi-briefcase display-1 text-muted mb-3"></i>
                    <h3 class="mb-2">No projects yet</h3>
                    <p>We're working on exciting new projects. Check back soon!</p>
                    <a href="#contact" class="btn btn-primary"><i class="bi bi-envelope me-2"></i>Get in Touch</a>
                </div>
            @endforelse
        </div>

        @if($projects->count() > 0)
            <div class="text-center mt-5" data-aos="fade-up" data-aos-delay="200">
                <a href="#contact" class="btn btn-primary">Start Your Project</a>
            </div>
        @endif
    </div>
</section>
