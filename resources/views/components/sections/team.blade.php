@php
$members = \App\Models\TeamMember::where('status', 'published')->orderBy('display_order')->get();
$stats = \App\Models\Stat::getStatsBySection('team');
@endphp

<section id="team" class="section bg-white">
    <div class="container py-16">
        <div class="text-center mb-12" data-aos="fade-up">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Our Team</h2>
            <p class="text-gray-500">Meet the talented individuals behind our success</p>
        </div>

        @if($members->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-16">
                @foreach($members as $index => $member)
                    <div class="group bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
                        <div class="relative overflow-hidden">
                            @if($member->image)
                                <div class="w-full aspect-[4/5] bg-slate-100">
                                    <img src="{{ $member->image }}" alt="{{ $member->name }}" class="w-full h-full object-cover object-top transition-transform duration-500 group-hover:scale-110">
                                </div>
                            @else
                                <div class="w-full aspect-[4/5] bg-gradient-to-br from-slate-700 to-slate-900 flex items-center justify-center">
                                    <span class="text-5xl font-bold text-white">
                                        {{ implode('', array_map(fn($n) => $n[0], explode(' ', $member->name))) }}
                                    </span>
                                </div>
                            @endif
                            
                            @if($member->facebook_url || $member->twitter_url || $member->linkedin_url || $member->instagram_url)
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end justify-center pb-4">
                                    <div class="flex gap-3">
                                        @if($member->facebook_url && $member->facebook_url !== '#')
                                            <a href="{{ $member->facebook_url }}" target="_blank" class="w-9 h-9 bg-white rounded-full flex items-center justify-center text-slate-700 hover:bg-blue-500 hover:text-white transition-colors">
                                                <i class="bi bi-facebook"></i>
                                            </a>
                                        @endif
                                        @if($member->twitter_url && $member->twitter_url !== '#')
                                            <a href="{{ $member->twitter_url }}" target="_blank" class="w-9 h-9 bg-white rounded-full flex items-center justify-center text-slate-700 hover:bg-slate-800 hover:text-white transition-colors">
                                                <i class="bi bi-twitter-x"></i>
                                            </a>
                                        @endif
                                        @if($member->linkedin_url && $member->linkedin_url !== '#')
                                            <a href="{{ $member->linkedin_url }}" target="_blank" class="w-9 h-9 bg-white rounded-full flex items-center justify-center text-slate-700 hover:bg-blue-600 hover:text-white transition-colors">
                                                <i class="bi bi-linkedin"></i>
                                            </a>
                                        @endif
                                        @if($member->instagram_url && $member->instagram_url !== '#')
                                            <a href="{{ $member->instagram_url }}" target="_blank" class="w-9 h-9 bg-white rounded-full flex items-center justify-center text-slate-700 hover:bg-gradient-to-br hover:from-yellow-400 hover:to-pink-500 hover:text-white transition-colors">
                                                <i class="bi bi-instagram"></i>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </div>
                        
                        <div class="p-5 text-center">
                            <h4 class="text-lg font-bold text-slate-800">{{ $member->name }}</h4>
                            @if($member->role)
                                <p class="text-sm text-blue-500 font-medium mt-1">{{ $member->role }}</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12 mb-16">
                <i class="bi bi-people text-6xl text-gray-300 mb-4"></i>
                <p class="text-gray-500">Our team is growing. Check back soon!</p>
            </div>
        @endif

        <!-- Team Stats -->
        @if($stats->count() > 0)
            <div class="bg-gradient-to-r from-slate-800 to-slate-900 rounded-2xl p-8 md:p-12" data-aos="fade-up" data-aos-delay="500">
                <div class="grid gap-8 text-center {{ $stats->count() === 3 ? 'grid-cols-1 md:grid-cols-3' : ($stats->count() === 2 ? 'grid-cols-2' : 'grid-cols-2 md:grid-cols-4') }}">
                    @foreach($stats->sortBy('display_order') as $index => $stat)
                        <div class="{{ $index > 0 && $stats->count() != 2 ? 'hidden md:block border-l border-slate-700 pl-8' : '' }}">
                            <span class="block text-4xl md:text-5xl font-bold text-white mb-2">{{ $stat->value }}</span>
                            <span class="text-slate-400 text-sm uppercase tracking-wide">{{ $stat->label }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</section>
