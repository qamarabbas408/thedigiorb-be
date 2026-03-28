<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\Stat;
use App\Models\TeamMember;
use App\Models\Testimonial;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->seedCategories();
        $this->seedServices();
        $this->seedSettings();
        $this->seedStats();
        $this->seedTeamMembers();
        $this->seedTestimonials();
    }

    private function seedCategories()
    {
        $categories = [
            ['id' => 'web-design', 'name' => 'Web Design', 'slug' => 'web-design', 'filter_class' => 'filter-web', 'icon' => 'bi-globe'],
            ['id' => 'mobile-design', 'name' => 'Mobile Design', 'slug' => 'mobile-design', 'filter_class' => 'filter-mobile', 'icon' => 'bi-phone'],
            ['id' => 'branding', 'name' => 'Branding', 'slug' => 'branding', 'filter_class' => 'filter-branding', 'icon' => 'bi-palette'],
            ['id' => 'ui-ux', 'name' => 'UI/UX', 'slug' => 'ui-ux', 'filter_class' => 'filter-ui', 'icon' => 'bi-ui-checks'],
            ['id' => 'desktop-app', 'name' => 'Desktop Application', 'slug' => 'desktop-application', 'filter_class' => 'filter-desktop', 'icon' => 'bi-laptop'],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(['id' => $category['id']], $category);
        }
    }

    private function seedServices()
    {
        $services = [
            ['id' => '1', 'title' => 'Web Development', 'description' => 'Professional web development services using modern technologies like React, Next.js, and Node.js to build responsive and performant websites.', 'icon' => 'bi-code-slash', 'featured' => true, 'display_order' => 1, 'status' => 'published'],
            ['id' => '2', 'title' => 'Mobile App Development', 'description' => 'Cross-platform mobile app development for iOS and Android using React Native and Flutter frameworks.', 'icon' => 'bi-phone', 'featured' => true, 'display_order' => 2, 'status' => 'published'],
            ['id' => '3', 'title' => 'UI/UX Design', 'description' => 'User-centered design solutions including wireframing, prototyping, and visual design to create engaging digital experiences.', 'icon' => 'bi-palette', 'featured' => true, 'display_order' => 3, 'status' => 'published'],
            ['id' => '4', 'title' => 'E-Commerce Solutions', 'description' => 'End-to-end e-commerce development with secure payment integrations, inventory management, and customizable storefronts.', 'icon' => 'bi-cart', 'featured' => false, 'display_order' => 4, 'status' => 'published'],
            ['id' => '5', 'title' => 'Cloud Services', 'description' => 'Cloud infrastructure setup, migration, and management using AWS, Azure, and Google Cloud platforms.', 'icon' => 'bi-cloud', 'featured' => false, 'display_order' => 5, 'status' => 'published'],
            ['id' => '6', 'title' => 'Digital Marketing', 'description' => 'Comprehensive digital marketing strategies including SEO, social media marketing, and content marketing to grow your online presence.', 'icon' => 'bi-megaphone', 'featured' => false, 'display_order' => 6, 'status' => 'published'],
        ];

        foreach ($services as $service) {
            Service::updateOrCreate(['id' => $service['id']], $service);
        }
    }

    private function seedSettings()
    {
        $settings = [
            ['setting_key' => 'company_name', 'setting_value' => 'DigitalOrbit'],
            ['setting_key' => 'company_email', 'setting_value' => 'support@digitalorbit.org'],
            ['setting_key' => 'company_phone', 'setting_value' => '+92 311 1588908'],
            ['setting_key' => 'company_address', 'setting_value' => 'Pakistan'],
            ['setting_key' => 'company_description', 'setting_value' => 'Building innovative digital solutions for your business. We specialize in web development, mobile applications, and custom software.'],
            ['setting_key' => 'logo_type', 'setting_value' => 'text'],
            ['setting_key' => 'logo_image', 'setting_value' => ''],
            ['setting_key' => 'favicon', 'setting_value' => ''],
            ['setting_key' => 'facebook_url', 'setting_value' => '#'],
            ['setting_key' => 'twitter_url', 'setting_value' => '#'],
            ['setting_key' => 'linkedin_url', 'setting_value' => '#'],
            ['setting_key' => 'instagram_url', 'setting_value' => '#'],
        ];

        foreach ($settings as $setting) {
            SiteSetting::updateOrCreate(['setting_key' => $setting['setting_key']], $setting);
        }
    }

    private function seedStats()
    {
        $stats = [
            ['id' => 'hero_1', 'section' => 'hero', 'label' => 'Projects Delivered', 'value' => '150+', 'icon' => 'bi-briefcase', 'display_order' => 1, 'status' => 'published'],
            ['id' => 'hero_2', 'section' => 'hero', 'label' => 'Client Satisfaction', 'value' => '98%', 'icon' => 'bi-heart', 'display_order' => 2, 'status' => 'published'],
            ['id' => 'hero_3', 'section' => 'hero', 'label' => 'Years Experience', 'value' => '12+', 'icon' => 'bi-calendar', 'display_order' => 3, 'status' => 'published'],
            ['id' => 'hero_4', 'section' => 'hero', 'label' => 'Team Experts', 'value' => '40+', 'icon' => 'bi-people', 'display_order' => 4, 'status' => 'published'],
            ['id' => 'about_1', 'section' => 'about', 'label' => 'Years of Excellence', 'value' => '12', 'icon' => 'bi-award', 'display_order' => 1, 'status' => 'published'],
            ['id' => 'about_2', 'section' => 'about', 'label' => 'Projects Done', 'value' => '150', 'icon' => 'bi-check-circle', 'display_order' => 2, 'status' => 'published'],
            ['id' => 'about_3', 'section' => 'about', 'label' => 'Happy Clients', 'value' => '85', 'icon' => 'bi-emoji-smile', 'display_order' => 3, 'status' => 'published'],
            ['id' => 'about_4', 'section' => 'about', 'label' => 'Retention', 'value' => '95%', 'icon' => 'bi-graph-up', 'display_order' => 4, 'status' => 'published'],
            ['id' => 'services_1', 'section' => 'services', 'label' => 'Projects Delivered', 'value' => '250+', 'icon' => 'bi-briefcase', 'display_order' => 1, 'status' => 'published'],
            ['id' => 'services_2', 'section' => 'services', 'label' => 'Client Satisfaction', 'value' => '98%', 'icon' => 'bi-heart', 'display_order' => 2, 'status' => 'published'],
            ['id' => 'services_3', 'section' => 'services', 'label' => 'Years Experience', 'value' => '15+', 'icon' => 'bi-calendar', 'display_order' => 3, 'status' => 'published'],
            ['id' => 'services_4', 'section' => 'services', 'label' => 'Team Experts', 'value' => '40+', 'icon' => 'bi-people', 'display_order' => 4, 'status' => 'published'],
            ['id' => 'whyus_1', 'section' => 'why_us', 'label' => 'Successful Campaigns', 'value' => '180+', 'icon' => 'bi-megaphone', 'display_order' => 1, 'status' => 'published'],
            ['id' => 'whyus_2', 'section' => 'why_us', 'label' => 'Customer Satisfaction', 'value' => '95%', 'icon' => 'bi-heart', 'display_order' => 2, 'status' => 'published'],
            ['id' => 'whyus_3', 'section' => 'why_us', 'label' => 'Growth Achieved', 'value' => '320%', 'icon' => 'bi-graph-up-arrow', 'display_order' => 3, 'status' => 'published'],
            ['id' => 'contact_1', 'section' => 'contact', 'label' => 'Satisfaction', 'value' => '98%', 'icon' => 'bi-heart', 'display_order' => 1, 'status' => 'published'],
            ['id' => 'contact_2', 'section' => 'contact', 'label' => 'Support', 'value' => '24/7', 'icon' => 'bi-headset', 'display_order' => 2, 'status' => 'published'],
            ['id' => 'contact_3', 'section' => 'contact', 'label' => 'Projects', 'value' => '3.2k', 'icon' => 'bi-folder', 'display_order' => 3, 'status' => 'published'],
            ['id' => 'portfolio_1', 'section' => 'portfolio_details', 'label' => 'Monthly Users', 'value' => '25k+', 'icon' => 'bi-people', 'display_order' => 1, 'status' => 'published'],
            ['id' => 'portfolio_2', 'section' => 'portfolio_details', 'label' => 'Uptime', 'value' => '99.9%', 'icon' => 'bi-server', 'display_order' => 2, 'status' => 'published'],
            ['id' => 'portfolio_3', 'section' => 'portfolio_details', 'label' => 'Team Members', 'value' => '12', 'icon' => 'bi-person', 'display_order' => 3, 'status' => 'published'],
            ['id' => 'portfolio_4', 'section' => 'portfolio_details', 'label' => 'Client Rating', 'value' => '4.9', 'icon' => 'bi-star', 'display_order' => 4, 'status' => 'published'],
            ['id' => 'servicedetails_1', 'section' => 'service_details', 'label' => 'Projects Delivered', 'value' => '850+', 'icon' => 'bi-briefcase', 'display_order' => 1, 'status' => 'published'],
            ['id' => 'servicedetails_2', 'section' => 'service_details', 'label' => 'Client Satisfaction', 'value' => '99%', 'icon' => 'bi-heart', 'display_order' => 2, 'status' => 'published'],
            ['id' => 'servicedetails_3', 'section' => 'service_details', 'label' => 'Support Available', 'value' => '24/7', 'icon' => 'bi-headset', 'display_order' => 3, 'status' => 'published'],
        ];

        foreach ($stats as $stat) {
            Stat::updateOrCreate(['id' => $stat['id']], $stat);
        }
    }

    private function seedTeamMembers()
    {
        $members = [
            ['id' => '1', 'name' => 'Qamar Abbas', 'role' => 'Founder & CEO', 'bio' => 'Full-Stack Developer, React JS, Flutter, React Native, Swift, Laravel, Django. 5+ years of experience working with multinational clients, delivering scalable web and mobile solutions.', 'image' => '/assets/img/team/qamar.webp', 'display_order' => 1, 'status' => 'active'],
            ['id' => '2', 'name' => 'Sunail Abbas', 'role' => 'Co-Founder & Tech Lead', 'bio' => 'Developer, Full-Stack, Laravel, React JS, Flutter. 5+ years of experience building solutions for government departments, with a focus on reliability and efficiency.', 'image' => '/assets/img/team/sunail.webp', 'display_order' => 2, 'status' => 'active'],
            ['id' => '3', 'name' => 'Zafar Mirza', 'role' => 'Creative Director, UI/UX', 'bio' => 'A visionary UI/UX designer passionate about creating intuitive and engaging digital experiences. Skilled in user research, wireframing, prototyping, and visual design.', 'image' => '/assets/img/team/zafar.webp', 'display_order' => 3, 'status' => 'active'],
            ['id' => '4', 'name' => 'Tashmina Mehr', 'role' => 'Marketing Director, Marketing / SEO', 'bio' => 'A results-driven marketing expert specializing in digital strategy and SEO. Tashmina develops and executes innovative marketing campaigns to drive brand awareness.', 'image' => '/assets/img/team/tashmina.webp', 'display_order' => 4, 'status' => 'active'],
        ];

        foreach ($members as $member) {
            TeamMember::updateOrCreate(['id' => $member['id']], $member);
        }
    }

    private function seedTestimonials()
    {
        $testimonials = [
            ['id' => '1', 'name' => 'Sarah K.', 'title' => 'IT Director', 'company' => 'RetailCorp', 'content' => 'We were facing a major challenge integrating our legacy systems with a new e-commerce platform. DigitalOrbit not only provided a seamless solution but also offered valuable insights that improved our overall data management. Their team\'s technical expertise is truly impressive.', 'rating' => 5, 'image' => '', 'featured' => true, 'status' => 'published'],
            ['id' => '2', 'name' => 'Mark L.', 'title' => 'CEO', 'company' => 'SmallBiz Solutions', 'content' => 'Working with DigitalOrbit was a refreshing experience. They kept us informed throughout the entire project, clearly explaining technical concepts and proactively addressing any concerns. The project was completed on time and within budget.', 'rating' => 5, 'image' => '', 'featured' => true, 'status' => 'published'],
            ['id' => '3', 'name' => 'Emily R.', 'title' => 'Product Manager', 'company' => 'TechStart Inc.', 'content' => 'DigitalOrbit brought a fresh perspective to our mobile app development project. They suggested innovative features and design elements that significantly enhanced the user experience. We\'ve seen a noticeable increase in user engagement since the launch.', 'rating' => 5, 'image' => '', 'featured' => false, 'status' => 'published'],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::updateOrCreate(['id' => $testimonial['id']], $testimonial);
        }
    }
}
