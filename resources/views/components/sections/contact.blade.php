@php
$stats = \App\Models\Stat::getStatsBySection('contact');
@endphp

<section id="contact" class="py-20 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Contact</h2>
            <p class="text-gray-500 text-lg">Get in touch with us for your next project</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8" data-aos="fade-up" data-aos-delay="100">
            <!-- Info Panel -->
            <div class="lg:col-span-5">
                <div class="bg-gradient-to-br from-slate-800 to-slate-900 rounded-2xl p-8 text-white h-full">
                    <div class="mb-8">
                        <span class="inline-flex items-center gap-2 px-4 py-2 bg-blue-500/20 text-blue-300 rounded-full text-sm font-medium mb-4">
                            Get In Touch
                        </span>
                        <h3 class="text-2xl font-bold mb-2">Let's Build Something Amazing</h3>
                        <p class="text-slate-300">Ready to transform your ideas into reality? We'd love to hear from you.</p>
                    </div>

                    <div class="space-y-6 mb-8">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-white/10 rounded-xl flex items-center justify-center flex-shrink-0">
                                <i class="bi bi-envelope text-xl"></i>
                            </div>
                            <div>
                                <p class="text-sm text-slate-400 mb-1">Email Us</p>
                                <a href="mailto:{{ $settings['company_email'] }}" class="text-white hover:text-blue-300 transition-colors">
                                    {{ $settings['company_email'] ?? 'N/A' }}
                                </a>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-white/10 rounded-xl flex items-center justify-center flex-shrink-0">
                                <i class="bi bi-telephone text-xl"></i>
                            </div>
                            <div>
                                <p class="text-sm text-slate-400 mb-1">Call Us</p>
                                <a href="tel:{{ str_replace(' ', '', $settings['company_phone'] ?? '') }}" class="text-white hover:text-blue-300 transition-colors">
                                    {{ $settings['company_phone'] ?? 'N/A' }}
                                </a>
                            </div>
                        </div>

                        @if(!empty($settings['company_address']))
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 bg-white/10 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <i class="bi bi-geo-alt text-xl"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-slate-400 mb-1">Location</p>
                                    <p class="text-white">{{ $settings['company_address'] }}</p>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Stats -->
                    @if($stats->count() > 0)
                        <div class="grid grid-cols-{{ min($stats->count(), 3) }} gap-4 py-6 border-t border-b border-white/10 mb-8">
                            @foreach($stats->sortBy('display_order') as $stat)
                                <div class="text-center">
                                    <p class="text-2xl font-bold text-blue-400">{{ $stat->value }}</p>
                                    <p class="text-xs text-slate-400">{{ $stat->label }}</p>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <!-- Social -->
                    <div>
                        <p class="text-sm text-slate-400 mb-3">Follow Us</p>
                        <div class="flex gap-3">
                            @if($settings['facebook_url'])
                                <a href="{{ $settings['facebook_url'] }}" class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center hover:bg-blue-500 transition-colors">
                                    <i class="bi bi-facebook"></i>
                                </a>
                            @endif
                            @if($settings['twitter_url'])
                                <a href="{{ $settings['twitter_url'] }}" class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center hover:bg-blue-500 transition-colors">
                                    <i class="bi bi-twitter-x"></i>
                                </a>
                            @endif
                            @if($settings['linkedin_url'])
                                <a href="{{ $settings['linkedin_url'] }}" class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center hover:bg-blue-500 transition-colors">
                                    <i class="bi bi-linkedin"></i>
                                </a>
                            @endif
                            @if($settings['instagram_url'])
                                <a href="{{ $settings['instagram_url'] }}" class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center hover:bg-blue-500 transition-colors">
                                    <i class="bi bi-instagram"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form -->
            <div class="lg:col-span-7">
                <div class="bg-white rounded-2xl shadow-lg p-8 h-full">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-14 h-14 bg-blue-100 rounded-2xl flex items-center justify-center">
                            <i class="bi bi-send text-blue-600 text-xl"></i>
                        </div>
                        <div>
                            <h4 class="text-xl font-bold text-gray-900">Send Us a Message</h4>
                            <p class="text-gray-500 text-sm">Fill out the form and our team will respond within 24 hours.</p>
                        </div>
                    </div>

                    <form action="{{ route('contact.submit') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Your Name *</label>
                                <input type="text" name="name" required placeholder="John Doe" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all text-gray-700">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Email Address *</label>
                                <input type="email" name="email" required placeholder="john@example.com" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all text-gray-700">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                                <input type="tel" name="phone" placeholder="+92 300 1234567" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all text-gray-700">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Subject</label>
                                <input type="text" name="subject" placeholder="How can we help?" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all text-gray-700">
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Your Message *</label>
                                <textarea name="message" rows="5" required placeholder="Tell us about your project..." class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all text-gray-700 resize-none"></textarea>
                            </div>
                        </div>

                        <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4 pt-4 border-t border-gray-100">
                            <button type="submit" class="px-8 py-3 bg-blue-600 text-white font-semibold rounded-xl hover:bg-blue-700 transition-colors flex items-center gap-2">
                                Send Message <i class="bi bi-send"></i>
                            </button>
                            <div class="flex items-center gap-2 text-sm text-gray-500">
                                <i class="bi bi-lock text-green-500"></i>
                                <span>Your data is encrypted and secure</span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
