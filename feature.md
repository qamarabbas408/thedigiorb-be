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

### Contacts API
Base URL: `/api/contacts`

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/api/contacts` | Get all contacts (supports `?status=` filter) |
| POST | `/api/contacts` | Create new contact |
| GET | `/api/contacts/{id}` | Get single contact |
| PUT | `/api/contacts/{id}` | Update contact status |
| DELETE | `/api/contacts/{id}` | Delete contact |

#### Create Contact (POST /api/contacts)
```json
{
  "name": "John Doe",
  "email": "john@example.com",
  "subject": "Inquiry",
  "message": "Hello, I have a question...",
  "phone": "+1234567890"
}
```

#### Update Contact Status (PUT /api/contacts/{id})
```json
{
  "status": "read"
}
```

### Migration Commands
```bash
php8.5 artisan migrate
```
