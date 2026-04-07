@php
$stats = \App\Models\Stat::getStatsBySection('contact');
@endphp

<section id="contact" class="contact section">
    <div class="container">
        <div class="section-title" data-aos="fade-up">
            <h2>Contact</h2>
            <p>{{ $settings['contact_description'] ?? 'Get in touch with us for your next project' }}</p>
        </div>

        <div class="row gy-4">
            <div class="col-lg-5">
                <div class="info-wrap" data-aos="fade-up">
                    <h3>Get in Touch</h3>
                    <p class="mb-4">We're here to help with your next project.</p>
                    <div class="info-item d-flex">
                        <i class="bi bi-geo-alt flex-shrink-0 me-3"></i>
                        <div>
                            <h5>Location</h5>
                            <p>{{ $settings['company_address'] ?? 'Your Address' }}</p>
                        </div>
                    </div>
                    <div class="info-item d-flex">
                        <i class="bi bi-envelope flex-shrink-0 me-3"></i>
                        <div>
                            <h5>Email</h5>
                            <p>{{ $settings['company_email'] ?? 'email@example.com' }}</p>
                        </div>
                    </div>
                    <div class="info-item d-flex">
                        <i class="bi bi-phone flex-shrink-0 me-3"></i>
                        <div>
                            <h5>Phone</h5>
                            <p>{{ $settings['company_phone'] ?? '+1 234 567 890' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-7">
                <form action="{{ route('contact.submit') }}" method="POST" class="php-email-form" data-aos="fade-up" data-aos-delay="100">
                    @csrf
                    <div class="row gy-4">
                        <div class="col-md-6">
                            <label for="name" class="pb-2">Your Name</label>
                            <input type="text" name="name" id="name" class="form-control" required placeholder="Your Name">
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="pb-2">Your Email</label>
                            <input type="email" class="form-control" name="email" id="email" required placeholder="Your Email">
                        </div>
                        <div class="col-md-6">
                            <label for="phone" class="pb-2">Phone</label>
                            <input type="tel" class="form-control" name="phone" id="phone" placeholder="Phone Number">
                        </div>
                        <div class="col-md-6">
                            <label for="subject" class="pb-2">Subject</label>
                            <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject">
                        </div>
                        <div class="col-md-12">
                            <label for="message" class="pb-2">Message</label>
                            <textarea class="form-control" name="message" id="message" rows="5" required placeholder="Your Message"></textarea>
                        </div>
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-primary">Send Message</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
