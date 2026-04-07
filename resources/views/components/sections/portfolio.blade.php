@php
$projects = \App\Models\Project::getPublished();
$categories = \App\Models\Category::orderBy('display_order')->get();
@endphp

<section id="portfolio" class="portfolio section bg-gray-50">
    <div class="container py-16">
        <div class="section-title text-center mb-12" data-aos="fade-up">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Portfolio</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">Our Work & Projects</p>
        </div>

        <div class="row g-4" data-aos="fade-up" data-aos-delay="100">
            @forelse($projects as $project)
                <div class="col-lg-4 col-md-6">
                    <div class="project-card bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transition-shadow">
                        <div class="relative overflow-hidden">
                            <img src="{{ $project->image ?? 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=600&h=400&fit=crop' }}" alt="{{ $project->title }}" class="w-full h-64 object-cover transition-transform duration-500 hover:scale-110">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-transparent to-transparent opacity-0 hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                <div class="flex gap-3">
                                    <span class="w-10 h-10 bg-white/90 rounded-full flex items-center justify-center text-slate-700 hover:bg-white transition-colors cursor-pointer">
                                        <i class="bi bi-eye"></i>
                                    </span>
                                    <span class="w-10 h-10 bg-white/90 rounded-full flex items-center justify-center text-slate-700 hover:bg-white transition-colors cursor-pointer">
                                        <i class="bi bi-arrow-right-short"></i>
                                    </span>
                                </div>
                            </div>
                            @if($project->category)
                                <span class="absolute top-4 left-4 bg-white/90 text-gray-700 text-xs font-medium px-3 py-1 rounded-full">
                                    {{ $project->category->name ?? '' }}
                                </span>
                            @endif
                            @if($project->featured)
                                <span class="absolute top-4 right-4 bg-blue-600 text-white text-xs font-medium px-3 py-1 rounded-full flex items-center gap-1">
                                    <i class="bi bi-star-fill"></i> Featured
                                </span>
                            @endif
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $project->title }}</h3>
                            @if($project->subtitle)
                                <p class="text-sm text-blue-600 font-medium mb-2">{{ $project->subtitle }}</p>
                            @endif
                            <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $project->description }}</p>
                            @if($project->technologies && is_array($project->technologies))
                                <div class="flex flex-wrap gap-2 mb-4">
                                    @foreach($project->technologies as $tech)
                                        <span class="bg-gray-100 text-gray-700 text-xs px-2 py-1 rounded">{{ $tech }}</span>
                                    @endforeach
                                </div>
                            @endif
                            <a href="#contact" class="inline-flex items-center gap-2 text-blue-600 font-medium hover:text-blue-700 text-sm">
                                View Details <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-12">
                    <i class="bi bi-briefcase text-6xl text-gray-300 mb-4"></i>
                    <h3 class="text-xl font-bold text-gray-700 mb-2">No projects yet</h3>
                    <p class="text-gray-500 mb-6">We're working on exciting new projects. Check back soon!</p>
                    <a href="#contact" class="inline-flex items-center gap-2 bg-blue-600 text-white px-6 py-3 rounded-full hover:bg-blue-700 transition-colors">
                        <i class="bi bi-envelope"></i> Get in Touch
                    </a>
                </div>
            @endforelse
        </div>

        @if($projects->count() > 0)
            <div class="cta-section bg-gradient-to-r from-blue-600 to-blue-700 rounded-2xl p-8 md:p-12 mt-12 text-center" data-aos="zoom-in" data-aos-delay="300">
                <span class="inline-flex items-center gap-2 text-blue-200 text-sm font-medium mb-4">
                    <i class="bi bi-lightning-charge-fill"></i> Ready to Start?
                </span>
                <h3 class="text-2xl md:text-3xl font-bold text-white mb-4">Let's Create Something Amazing Together</h3>
                <p class="text-blue-100 mb-8 max-w-2xl mx-auto">Have a project in mind? We'd love to hear about it and bring your vision to life.</p>
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="#contact" class="inline-flex items-center gap-2 bg-white text-blue-600 px-6 py-3 rounded-full hover:bg-gray-100 transition-colors font-medium">
                        Start Your Project <i class="bi bi-arrow-right"></i>
                    </a>
                    <a href="#services" class="inline-flex items-center gap-2 bg-blue-500 text-white px-6 py-3 rounded-full hover:bg-blue-400 transition-colors font-medium">
                        <i class="bi bi-play-circle"></i> Explore Services
                    </a>
                </div>
            </div>
        @endif
    </div>
</section>
