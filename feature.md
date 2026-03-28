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

### Migration Commands
```bash
php8.5 artisan migrate
```
