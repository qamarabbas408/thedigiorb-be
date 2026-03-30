<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\GlobalStat;
use App\Models\Project;
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
        $this->seedProjects();
        $this->seedServices();
        $this->seedSettings();
        $this->seedGlobalStats();
        $this->seedStats();
        $this->seedTeamMembers();
        $this->seedTestimonials();
    }

    private function seedGlobalStats()
    {
        $globalStats = [
            ['id' => 'gs_1', 'key' => 'projects_delivered', 'label' => 'Projects Delivered', 'value' => '150+', 'icon' => 'bi-briefcase', 'display_order' => 1, 'status' => 'published'],
            ['id' => 'gs_2', 'key' => 'happy_clients', 'label' => 'Happy Clients', 'value' => '85+', 'icon' => 'bi-emoji-smile', 'display_order' => 2, 'status' => 'published'],
            ['id' => 'gs_3', 'key' => 'years_experience', 'label' => 'Years Experience', 'value' => '12+', 'icon' => 'bi-calendar', 'display_order' => 3, 'status' => 'published'],
            ['id' => 'gs_4', 'key' => 'team_experts', 'label' => 'Team Experts', 'value' => '40+', 'icon' => 'bi-people', 'display_order' => 4, 'status' => 'published'],
            ['id' => 'gs_5', 'key' => 'client_satisfaction', 'label' => 'Client Satisfaction', 'value' => '98%', 'icon' => 'bi-heart', 'display_order' => 5, 'status' => 'published'],
            ['id' => 'gs_6', 'key' => 'support_available', 'label' => 'Support Available', 'value' => '24/7', 'icon' => 'bi-headset', 'display_order' => 6, 'status' => 'published'],
        ];

        foreach ($globalStats as $stat) {
            GlobalStat::updateOrCreate(['id' => $stat['id']], $stat);
        }
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

    private function seedProjects()
    {
        $projects = [
            ['id' => '1', 'title' => 'BookNStay', 'subtitle' => 'Hotel & Event Booking Platform', 'category_id' => 'web-design', 'year' => '2024-2025', 'technologies' => json_encode(['Laravel', 'ReactJS', 'MySQL', 'REST APIs']), 'description' => 'Developed a full-stack web application for the Gilgit Baltistan hospitality industry, enabling users to book hotels and events through a centralized platform. The system includes booking management, user authentication, and admin dashboards for efficient operations.', 'image' => '', 'gallery' => json_encode([]), 'featured' => true, 'client' => 'Hospitality Industry', 'url' => '#', 'status' => 'published'],
            ['id' => '2', 'title' => 'eSchool ERP', 'subtitle' => 'LMS + School Management System', 'category_id' => 'web-design', 'year' => '2024-2025', 'technologies' => json_encode(['Laravel', 'ReactJS', 'MySQL', 'REST APIs']), 'description' => 'Built a comprehensive ERP system combining LMS features with school management functionalities. The platform supports course management, student and teacher workflows, role-based access, and performance tracking dashboards.', 'image' => '', 'gallery' => json_encode([]), 'featured' => true, 'client' => 'Education Sector', 'url' => '#', 'status' => 'published'],
            ['id' => '3', 'title' => 'JPay', 'subtitle' => 'HR Management System', 'category_id' => 'web-design', 'year' => '2023-2024', 'technologies' => json_encode(['ReactJS', 'JavaScript', 'Axios', 'REST APIs']), 'description' => 'Developed a web-based HR system for managing companies and employees, including dashboards, employee data handling, and workflows.', 'image' => '', 'gallery' => json_encode([]), 'featured' => false, 'client' => 'Corporate', 'url' => '#', 'status' => 'published'],
            ['id' => '4', 'title' => 'SpeedyHR', 'subtitle' => 'Advanced HR Platform', 'category_id' => 'web-design', 'year' => '2023-2024', 'technologies' => json_encode(['ReactJS', 'Redux', 'JavaScript', 'REST APIs']), 'description' => 'Designed an advanced HR management system enabling organizations to manage employees, payroll processes, and internal workflows with improved efficiency.', 'image' => '', 'gallery' => json_encode([]), 'featured' => false, 'client' => 'HR Departments', 'url' => '#', 'status' => 'published'],
            ['id' => '5', 'title' => 'CloudMunshi', 'subtitle' => 'eCommerce Integration Platform', 'category_id' => 'web-design', 'year' => '2023-2024', 'technologies' => json_encode(['ReactJS', 'APIs Integration', 'JavaScript']), 'description' => 'Built a platform integrating multiple eCommerce stores into a unified system, allowing centralized monitoring and management of business operations.', 'image' => '', 'gallery' => json_encode([]), 'featured' => false, 'client' => 'eCommerce Businesses', 'url' => '#', 'status' => 'published'],
            ['id' => '6', 'title' => 'CloudInstaller', 'subtitle' => 'Build Distribution Platform', 'category_id' => 'web-design', 'year' => '2023', 'technologies' => json_encode(['ReactJS', 'JavaScript', 'File Management']), 'description' => 'Developed a web-based portal for sharing mobile application builds (IPA/APK) among teams and testers, enabling efficient version control and internal distribution.', 'image' => '', 'gallery' => json_encode([]), 'featured' => false, 'client' => 'Development Teams', 'url' => '#', 'status' => 'published'],
            ['id' => '7', 'title' => 'Zendesk Clone', 'subtitle' => 'Web Chat Application', 'category_id' => 'web-design', 'year' => '2023', 'technologies' => json_encode(['ReactJS', 'JavaScript', 'Real-time Communication']), 'description' => 'Developed a real-time web chat application with a user-friendly interface, enabling seamless communication and interaction between users.', 'image' => '', 'gallery' => json_encode([]), 'featured' => false, 'client' => 'Support Teams', 'url' => '#', 'status' => 'published'],
            ['id' => '12', 'title' => 'FinanceFlow Dashboard', 'subtitle' => 'Fintech UI/UX Design', 'category_id' => 'ui-ux', 'year' => '2024', 'technologies' => json_encode(['Figma', 'Prototyping', 'User Research']), 'description' => 'Designed a comprehensive financial dashboard for a fintech startup, focusing on data visualization, user-friendly navigation, and accessibility. Included wireframes, high-fidelity mockups, and interactive prototypes.', 'image' => '', 'gallery' => json_encode([]), 'featured' => true, 'client' => 'FinanceFlow', 'url' => '#', 'status' => 'published'],
            ['id' => '13', 'title' => 'HealthTrack App', 'subtitle' => 'Healthcare UI/UX Design', 'category_id' => 'ui-ux', 'year' => '2024', 'technologies' => json_encode(['Figma', 'Adobe XD', 'User Testing']), 'description' => 'Created an intuitive health tracking mobile application design with focus on elderly users. Conducted user research and usability testing to ensure accessible interface patterns.', 'image' => '', 'gallery' => json_encode([]), 'featured' => true, 'client' => 'HealthTech Inc', 'url' => '#', 'status' => 'published'],
            ['id' => '14', 'title' => 'ShopNest', 'subtitle' => 'E-commerce Redesign', 'category_id' => 'ui-ux', 'year' => '2023', 'technologies' => json_encode(['Figma', 'Design System', 'Mobile-first']), 'description' => 'Redesigned a complete e-commerce platform with modern UI patterns, optimized checkout flow, and cohesive design system. Increased conversion rate by 25% through UX improvements.', 'image' => '', 'gallery' => json_encode([]), 'featured' => false, 'client' => 'ShopNest Retail', 'url' => '#', 'status' => 'published'],
            ['id' => '15', 'title' => 'Nexus Bank Rebrand', 'subtitle' => 'Corporate Identity', 'category_id' => 'branding', 'year' => '2024', 'technologies' => json_encode(['Logo Design', 'Brand Guidelines', 'Stationery']), 'description' => 'Created complete brand identity for a modern digital bank, including logo, color palette, typography, and comprehensive brand guidelines for consistent application.', 'image' => '', 'gallery' => json_encode([]), 'featured' => true, 'client' => 'Nexus Bank', 'url' => '#', 'status' => 'published'],
            ['id' => '16', 'title' => 'GreenEarth Logo', 'subtitle' => 'Environmental Brand Identity', 'category_id' => 'branding', 'year' => '2023', 'technologies' => json_encode(['Logo Design', 'Brand Strategy', 'Visual Identity']), 'description' => 'Developed eco-friendly brand identity for an environmental consulting firm, featuring sustainable design elements and earth-toned color palette.', 'image' => '', 'gallery' => json_encode([]), 'featured' => false, 'client' => 'GreenEarth Solutions', 'url' => '#', 'status' => 'published'],
            ['id' => '17', 'title' => 'Urban Eats', 'subtitle' => 'Restaurant Brand Identity', 'category_id' => 'branding', 'year' => '2024', 'technologies' => json_encode(['Logo', 'Menu Design', 'Signage', 'Social Media']), 'description' => 'Created vibrant brand identity for a modern fast-casual restaurant chain, including logo, menu designs, interior signage, and social media templates.', 'image' => '', 'gallery' => json_encode([]), 'featured' => false, 'client' => 'Urban Eats', 'url' => '#', 'status' => 'published'],
            ['id' => '18', 'title' => 'TechDesk Pro', 'subtitle' => 'Desktop Application', 'category_id' => 'desktop-app', 'year' => '2024', 'technologies' => json_encode(['Electron', 'React', 'Node.js', 'SQLite']), 'description' => 'Developed a comprehensive help desk management desktop application with ticket tracking, knowledge base, and reporting features. Built with Electron for cross-platform compatibility.', 'image' => '', 'gallery' => json_encode([]), 'featured' => true, 'client' => 'TechDesk Inc', 'url' => '#', 'status' => 'published'],
            ['id' => '19', 'title' => 'DataViz Studio', 'subtitle' => 'Desktop Analytics Tool', 'category_id' => 'desktop-app', 'year' => '2023', 'technologies' => json_encode(['Electron', 'D3.js', 'Python', 'PostgreSQL']), 'description' => 'Created a powerful data visualization desktop application for business analytics, featuring interactive charts, real-time data connection, and custom report generation.', 'image' => '', 'gallery' => json_encode([]), 'featured' => true, 'client' => 'DataViz Corp', 'url' => '#', 'status' => 'published'],
            ['id' => '20', 'title' => 'SecureVault', 'subtitle' => 'Password Manager Desktop App', 'category_id' => 'desktop-app', 'year' => '2024', 'technologies' => json_encode(['Electron', 'React', 'Encryption', 'Local Storage']), 'description' => 'Built a secure password management application with AES-256 encryption, biometric authentication, and cross-device sync capabilities.', 'image' => '', 'gallery' => json_encode([]), 'featured' => false, 'client' => 'SecureVault Labs', 'url' => '#', 'status' => 'published'],
        ];

        foreach ($projects as $project) {
            Project::updateOrCreate(['id' => $project['id']], $project);
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
            ['setting_key' => 'company_email', 'setting_value' => 'support@thedigiorb.com'],
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
            ['setting_key' => 'logo_text', 'setting_value' => ''],
        ];

        foreach ($settings as $setting) {
            SiteSetting::updateOrCreate(['setting_key' => $setting['setting_key']], $setting);
        }
    }

    private function seedStats()
    {
        // Section-specific stats only (unique to each section)
        // Global stats should be managed in GlobalStats
        $stats = [
            // Hero section - no section-specific stats, uses global stats
            // About section
            ['id' => 'about_1', 'section' => 'about', 'label' => 'Years of Excellence', 'value' => '12', 'icon' => 'bi-award', 'display_order' => 1, 'status' => 'published'],
            ['id' => 'about_2', 'section' => 'about', 'label' => 'Retention Rate', 'value' => '95%', 'icon' => 'bi-graph-up', 'display_order' => 2, 'status' => 'published'],
            // Services section - no section-specific stats
            // Why Us section
            ['id' => 'whyus_1', 'section' => 'why_us', 'label' => 'Successful Campaigns', 'value' => '180+', 'icon' => 'bi-megaphone', 'display_order' => 1, 'status' => 'published'],
            ['id' => 'whyus_2', 'section' => 'why_us', 'label' => 'Growth Achieved', 'value' => '320%', 'icon' => 'bi-graph-up-arrow', 'display_order' => 2, 'status' => 'published'],
            // Contact section
            ['id' => 'contact_1', 'section' => 'contact', 'label' => 'Response Time', 'value' => '<1hr', 'icon' => 'bi-lightning', 'display_order' => 1, 'status' => 'published'],
            ['id' => 'contact_2', 'section' => 'contact', 'label' => 'Projects Completed', 'value' => '3.2k+', 'icon' => 'bi-folder', 'display_order' => 2, 'status' => 'published'],
            // Portfolio details section
            ['id' => 'portfolio_1', 'section' => 'portfolio_details', 'label' => 'Monthly Users', 'value' => '25k+', 'icon' => 'bi-people', 'display_order' => 1, 'status' => 'published'],
            ['id' => 'portfolio_2', 'section' => 'portfolio_details', 'label' => 'Uptime', 'value' => '99.9%', 'icon' => 'bi-server', 'display_order' => 2, 'status' => 'published'],
            ['id' => 'portfolio_3', 'section' => 'portfolio_details', 'label' => 'Team Members', 'value' => '12', 'icon' => 'bi-person', 'display_order' => 3, 'status' => 'published'],
            ['id' => 'portfolio_4', 'section' => 'portfolio_details', 'label' => 'Client Rating', 'value' => '4.9/5', 'icon' => 'bi-star', 'display_order' => 4, 'status' => 'published'],
            // Service details section
            ['id' => 'servicedetails_1', 'section' => 'service_details', 'label' => 'On-Time Delivery', 'value' => '99%', 'icon' => 'bi-clock', 'display_order' => 1, 'status' => 'published'],
            ['id' => 'servicedetails_2', 'section' => 'service_details', 'label' => 'Repeat Clients', 'value' => '85%', 'icon' => 'bi-arrow-repeat', 'display_order' => 2, 'status' => 'published'],
        ];

        foreach ($stats as $stat) {
            Stat::updateOrCreate(['id' => $stat['id']], $stat);
        }
    }

    private function seedTeamMembers()
    {
        $members = [
            ['id' => '1', 'name' => 'Qamar Abbas', 'role' => 'Founder & CEO', 'bio' => 'Full-Stack Developer, React JS, Flutter, React Native, Swift, Laravel, Django. 5+ years of experience working with multinational clients, delivering scalable web and mobile solutions.', 'image' => '', 'display_order' => 1, 'status' => 'active'],
            ['id' => '2', 'name' => 'Sunail Abbas', 'role' => 'Co-Founder & Tech Lead', 'bio' => 'Developer, Full-Stack, Laravel, React JS, Flutter. 5+ years of experience building solutions for government departments, with a focus on reliability and efficiency.', 'image' => '', 'display_order' => 2, 'status' => 'active'],
            ['id' => '3', 'name' => 'Zafar Mirza', 'role' => 'Creative Director, UI/UX', 'bio' => 'A visionary UI/UX designer passionate about creating intuitive and engaging digital experiences. Skilled in user research, wireframing, prototyping, and visual design.', 'image' => '', 'display_order' => 3, 'status' => 'active'],
            ['id' => '4', 'name' => 'Tashmina Mehr', 'role' => 'Marketing Director, Marketing / SEO', 'bio' => 'A results-driven marketing expert specializing in digital strategy and SEO. Tashmina develops and executes innovative marketing campaigns to drive brand awareness.', 'image' => '', 'display_order' => 4, 'status' => 'active'],
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
