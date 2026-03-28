# DigitalOrb Backend - Laravel Project

## Setup

### Environment
- **PHP Version:** 8.5.4
- **PHP Path:** `php8.5` (added to environment variables)
- **Platform:** Windows (win32)

### Laravel Installation

#### 1. Create New Laravel Project
```bash
php8.5 "D:/ProgramFiles/LocalServer/laragon/bin/composer/composer.phar" create-project laravel/laravel digiorb-be --prefer-dist
```

#### 2. Install Dependencies
```bash
php8.5 "D:/ProgramFiles/LocalServer/laragon/bin/composer/composer.phar" install
```

#### 3. Run Development Server
```bash
php8.5 artisan serve
```

### Versions
- **Laravel Framework:** 13.2.0 (latest stable)
- **PHP Required:** ^8.2 (for Laravel 13)

### Verify Installation
```bash
php8.5 artisan --version
# Output: Laravel Framework 13.2.0
```

## Project Structure
- `digiorb-be/` - Laravel application root
- `app/` - Application code
- `routes/` - Route definitions
- `database/` - Migrations and seeders
- `tests/` - Test files

## Packages Installed

### Livewire
```bash
php8.5 "D:/ProgramFiles/LocalServer/laragon/bin/composer/composer.phar" require livewire/livewire
```
- **Version:** 4.2.2

### Tailwind CSS
- **Version:** 4.2.2 (via `@tailwindcss/vite`)
- Already included with Laravel 13
- Configured in `vite.config.js`

### Build Frontend Assets
```bash
npm run build
```

### Run Vite Dev Server
```bash
npm run dev
```

## API Endpoints

All APIs are versioned under `/api/v1/*`. Future versions will use `/api/v2/*`.

### API Response Format

All API responses follow a consistent format using the `ApiResponse` trait.

#### Success Response
```json
{
  "success": true,
  "message": "Operation successful",
  "data": { ... }
}
```

#### Error Response
```json
{
  "success": false,
  "message": "Error description",
  "errors": { ... }
}
```

#### Paginated Response
```json
{
  "success": true,
  "data": [...],
  "meta": {
    "current_page": 1,
    "last_page": 5,
    "per_page": 15,
    "total": 100
  },
  "links": {
    "first": "...",
    "last": "...",
    "prev": null,
    "next": "..."
  }
}
```

#### HTTP Status Codes
| Code | Usage |
|------|-------|
| 200 | Success (GET, PUT, DELETE) |
| 201 | Created (POST) |
| 400 | Bad Request |
| 404 | Not Found |
| 422 | Validation Error |
| 500 | Server Error |

### Contacts API
Base URL: `/api/v1/contacts`

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/api/v1/contacts` | Get all contacts (supports `?status=` filter) |
| POST | `/api/v1/contacts` | Create new contact |
| GET | `/api/v1/contacts/{id}` | Get single contact |
| PUT | `/api/v1/contacts/{id}` | Update contact status |
| DELETE | `/api/v1/contacts/{id}` | Delete contact |

#### Create Contact (POST /api/v1/contacts)
```json
{
  "name": "John Doe",
  "email": "john@example.com",
  "subject": "Inquiry",
  "message": "Hello, I have a question...",
  "phone": "+1234567890"
}
```

#### Update Contact Status (PUT /api/v1/contacts/{id})
```json
{
  "status": "read"
}
```

### Portfolio Categories API
Base URL: `/api/v1/portfolio/categories`

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/api/v1/portfolio/categories` | Get all categories |
| POST | `/api/v1/portfolio/categories` | Create new category |
| PUT | `/api/v1/portfolio/categories` | Update category |
| DELETE | `/api/v1/portfolio/categories?id=` | Delete category |

#### Create Category (POST /api/v1/portfolio/categories)
```json
{
  "name": "Web Design",
  "icon": "bi-globe"
}
```

#### Update Category (PUT /api/v1/portfolio/categories)
```json
{
  "id": "web-design",
  "name": "Web Design Updated",
  "icon": "bi-display"
}
```

### Portfolio Projects API
Base URL: `/api/v1/portfolio/projects`

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/api/v1/portfolio/projects` | Get all projects (filters: `?categoryId=`, `?status=`) |
| POST | `/api/v1/portfolio/projects` | Create new project |
| GET | `/api/v1/portfolio/projects/{id}` | Get single project |
| PUT | `/api/v1/portfolio/projects/{id}` | Update project |
| DELETE | `/api/v1/portfolio/projects/{id}` | Delete project |

#### Create Project (POST /api/v1/portfolio/projects)
```json
{
  "title": "Project Title",
  "subtitle": "Project Subtitle",
  "categoryId": "web-design",
  "year": "2024",
  "technologies": ["Laravel", "React", "MySQL"],
  "description": "Project description...",
  "image": "/assets/img/portfolio/project.webp",
  "gallery": ["/assets/img/portfolio/gallery-1.webp"],
  "featured": true,
  "client": "Client Name",
  "url": "https://example.com",
  "status": "published"
}
```

#### Update Project (PUT /api/v1/portfolio/projects/{id})
```json
{
  "title": "Updated Title",
  "subtitle": "Updated Subtitle",
  "categoryId": "web-design",
  "year": "2024",
  "technologies": ["Laravel", "React"],
  "description": "Updated description...",
  "featured": false,
  "status": "draft"
}
```

### Services API
Base URL: `/api/v1/services`

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/api/v1/services` | Get all services (filters: `?status=`, `?featured=true`) |
| POST | `/api/v1/services` | Create new service |
| GET | `/api/v1/services/{id}` | Get single service |
| PUT | `/api/v1/services/{id}` | Update service |
| DELETE | `/api/v1/services/{id}` | Delete service |

#### Create Service (POST /api/v1/services)
```json
{
  "title": "Web Development",
  "description": "Professional web development services...",
  "icon": "bi-code-slash",
  "featured": true,
  "displayOrder": 1,
  "status": "published"
}
```

### Settings API
Base URL: `/api/v1/settings`

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/api/v1/settings` | Get all settings (key-value pairs) |
| PUT | `/api/v1/settings` | Update settings |

#### Get Settings (GET /api/v1/settings)
Returns key-value pairs of all settings.

#### Update Settings (PUT /api/v1/settings)
```json
{
  "site_name": "DigitalOrb",
  "site_email": "info@example.com",
  "site_description": "Your trusted partner for digital solutions"
}
```

### Stats API
Base URL: `/api/v1/stats`

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/api/v1/stats` | Get all stats (filters: `?section=`, `?status=`) |
| POST | `/api/v1/stats` | Create new stat |
| GET | `/api/v1/stats/{id}` | Get single stat |
| PUT | `/api/v1/stats/{id}` | Update stat |
| DELETE | `/api/v1/stats/{id}` | Delete stat |

#### Create Stat (POST /api/v1/stats)
```json
{
  "section": "home",
  "label": "Projects Completed",
  "value": "150+",
  "icon": "bi-briefcase",
  "displayOrder": 1,
  "status": "published"
}
```

### Team API
Base URL: `/api/v1/team`

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/api/v1/team` | Get all active team members |
| POST | `/api/v1/team` | Create new team member |
| GET | `/api/v1/team/{id}` | Get single team member |
| PUT | `/api/v1/team/{id}` | Update team member |
| DELETE | `/api/v1/team/{id}` | Delete team member |

#### Create Team Member (POST /api/v1/team)
```json
{
  "name": "John Doe",
  "role": "Lead Developer",
  "bio": "Experienced developer...",
  "image": "/assets/img/team/member.webp",
  "facebook_url": "https://facebook.com/",
  "twitter_url": "https://twitter.com/",
  "linkedin_url": "https://linkedin.com/",
  "instagram_url": "https://instagram.com/",
  "display_order": 1,
  "status": "active"
}
```

### Testimonials API
Base URL: `/api/v1/testimonials`

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/api/v1/testimonials` | Get all (filters: `?featured=true`, `?status=`) |
| POST | `/api/v1/testimonials` | Create new testimonial |
| GET | `/api/v1/testimonials/{id}` | Get single testimonial |
| PUT | `/api/v1/testimonials/{id}` | Update testimonial |
| DELETE | `/api/v1/testimonials/{id}` | Delete testimonial |

#### Create Testimonial (POST /api/v1/testimonials)
```json
{
  "name": "Jane Smith",
  "title": "CEO",
  "company": "Tech Corp",
  "content": "Great service! Highly recommended.",
  "rating": 5,
  "image": "/assets/img/testimonial.webp",
  "featured": true,
  "status": "published"
}
```

### Upload API
Base URL: `/api/v1/upload`

| Method | Endpoint | Description |
|--------|----------|-------------|
| POST | `/api/v1/upload` | Upload file |

#### Upload File (POST /api/v1/upload)
- Content-Type: `multipart/form-data`
- Body: `file` (required), `folder` (optional, default: "misc")

### Migration Commands
```bash
php8.5 artisan migrate
php8.5 artisan db:seed
```

### Seed Data
The seeder includes:
- **Categories**: 5 default portfolio categories (Web Design, Mobile Design, Branding, UI/UX, Desktop App)
- **Projects**: 16 sample projects across all categories (BookNStay, eSchool ERP, JPay, etc.)
- **Services**: 6 services with descriptions and icons
- **Settings**: Company info, contact details, social links
- **Stats**: 24 stats across sections (hero, about, services, why_us, contact, portfolio_details, service_details)
- **Team Members**: 4 team members (Qamar Abbas, Sunail Abbas, Zafar Mirza, Tashmina Mehr)
- **Testimonials**: 3 sample testimonials
