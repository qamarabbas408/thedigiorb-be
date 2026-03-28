# DigitalOrb API Documentation

All APIs are versioned under `/api/v1/*`. Future versions will use `/api/v2/*`.

Base URL: `http://localhost:8000/api/v1`

## API Response Format

All API responses follow a consistent format using the `ApiResponse` trait.

### Success Response
```json
{
  "success": true,
  "message": "Operation successful",
  "data": { ... }
}
```

### Error Response
```json
{
  "success": false,
  "message": "Error description",
  "errors": { ... }
}
```

### Paginated Response
```json
{
  "success": true,
  "data": [...],
  "meta": {
    "current_page": 1,
    "last_page": 5,
    "per_page": 15,
    "total": 100
  }
}
```

### HTTP Status Codes
| Code | Usage |
|------|-------|
| 200 | Success (GET, PUT, DELETE) |
| 201 | Created (POST) |
| 400 | Bad Request |
| 404 | Not Found |
| 422 | Validation Error |
| 500 | Server Error |

---

## Contacts API

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/contacts` | Get all contacts (supports `?status=` filter) |
| POST | `/contacts` | Create new contact |
| GET | `/contacts/{id}` | Get single contact |
| PUT | `/contacts/{id}` | Update contact status |
| DELETE | `/contacts/{id}` | Delete contact |

### Create Contact (POST /contacts)
```json
{
  "name": "John Doe",
  "email": "john@example.com",
  "subject": "Inquiry",
  "message": "Hello, I have a question...",
  "phone": "+1234567890"
}
```

---

## Portfolio Categories API

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/portfolio/categories` | Get all categories |
| POST | `/portfolio/categories` | Create new category |
| PUT | `/portfolio/categories` | Update category |
| DELETE | `/portfolio/categories?id=` | Delete category |

### Create Category (POST /portfolio/categories)
```json
{
  "name": "Web Design",
  "icon": "bi-globe"
}
```

---

## Portfolio Projects API

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/portfolio/projects` | Get all projects (filters: `?categoryId=`, `?status=`) |
| POST | `/portfolio/projects` | Create new project |
| GET | `/portfolio/projects/{id}` | Get single project |
| PUT | `/portfolio/projects/{id}` | Update project |
| DELETE | `/portfolio/projects/{id}` | Delete project |

### Create Project (POST /portfolio/projects)
```json
{
  "title": "Project Title",
  "subtitle": "Project Subtitle",
  "categoryId": "web-design",
  "year": "2024",
  "technologies": ["Laravel", "React", "MySQL"],
  "description": "Project description...",
  "image": "/assets/img/portfolio/project.webp",
  "gallery": ["/assets/img/gallery-1.webp"],
  "featured": true,
  "client": "Client Name",
  "url": "https://example.com",
  "status": "published"
}
```

---

## Services API

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/services` | Get all services (filters: `?status=`, `?featured=true`) |
| POST | `/services` | Create new service |
| GET | `/services/{id}` | Get single service |
| PUT | `/services/{id}` | Update service |
| DELETE | `/services/{id}` | Delete service |

### Create Service (POST /services)
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

---

## Settings API

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/settings` | Get all settings (key-value pairs) |
| PUT | `/settings` | Update settings |

### Update Settings (PUT /settings)
```json
{
  "site_name": "DigitalOrb",
  "site_email": "info@example.com",
  "site_description": "Your trusted partner for digital solutions"
}
```

---

## Stats API

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/stats` | Get all stats (filters: `?section=`, `?status=`) |
| POST | `/stats` | Create new stat |
| GET | `/stats/{id}` | Get single stat |
| PUT | `/stats/{id}` | Update stat |
| DELETE | `/stats/{id}` | Delete stat |

### Create Stat (POST /stats)
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

---

## Team API

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/team` | Get all active team members |
| POST | `/team` | Create new team member |
| GET | `/team/{id}` | Get single team member |
| PUT | `/team/{id}` | Update team member |
| DELETE | `/team/{id}` | Delete team member |

### Create Team Member (POST /team)
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

---

## Testimonials API

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/testimonials` | Get all (filters: `?featured=true`, `?status=`) |
| POST | `/testimonials` | Create new testimonial |
| GET | `/testimonials/{id}` | Get single testimonial |
| PUT | `/testimonials/{id}` | Update testimonial |
| DELETE | `/testimonials/{id}` | Delete testimonial |

### Create Testimonial (POST /testimonials)
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

---

## Upload API

| Method | Endpoint | Description |
|--------|----------|-------------|
| POST | `/upload` | Upload file |

### Upload File (POST /upload)
- Content-Type: `multipart/form-data`
- Body: `file` (required), `folder` (optional, default: "misc")
