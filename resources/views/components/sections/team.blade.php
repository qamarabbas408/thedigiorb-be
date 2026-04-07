@php
$members = \App\Models\TeamMember::where('status', 'active')->orderBy('display_order')->get();
@endphp

<section id="team" class="team section light-background">
    <div class="container">
        <div class="section-title" data-aos="fade-up">
            <h2>Team</h2>
            <p>{{ $settings['team_description'] ?? 'Meet the talented individuals behind our success' }}</p>
        </div>

        <div class="row gy-4">
            @forelse($members as $index => $member)
                <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
                    <div class="team-member">
                        <div class="member-img">
                            @if($member->image)
                                <img src="{{ $member->image }}" class="img-fluid" alt="{{ $member->name }}">
                            @else
                                <div class="bg-primary text-white d-flex align-items-center justify-content-center" style="height: 260px;">
                                    <span class="h1 mb-0">{{ implode('', array_map(fn($n) => $n[0], explode(' ', $member->name))) }}</span>
                                </div>
                            @endif
                            <div class="social">
                                @if($member->facebook_url && $member->facebook_url !== '#')
                                    <a href="{{ $member->facebook_url }}" target="_blank"><i class="bi bi-facebook"></i></a>
                                @endif
                                @if($member->twitter_url && $member->twitter_url !== '#')
                                    <a href="{{ $member->twitter_url }}" target="_blank"><i class="bi bi-twitter-x"></i></a>
                                @endif
                                @if($member->linkedin_url && $member->linkedin_url !== '#')
                                    <a href="{{ $member->linkedin_url }}" target="_blank"><i class="bi bi-linkedin"></i></a>
                                @endif
                                @if($member->instagram_url && $member->instagram_url !== '#')
                                    <a href="{{ $member->instagram_url }}" target="_blank"><i class="bi bi-instagram"></i></a>
                                @endif
                            </div>
                        </div>
                        <div class="member-info">
                            <h4>{{ $member->name }}</h4>
                            @if($member->role)
                                <span>{{ $member->role }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <i class="bi bi-people display-1 text-muted mb-3"></i>
                    <p>Our team is growing. Check back soon!</p>
                </div>
            @endforelse
        </div>
    </div>
</section>
