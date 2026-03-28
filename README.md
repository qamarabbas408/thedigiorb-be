# DigitalOrb Backend - Laravel API

## Setup

### Environment
- **PHP Version:** 8.5.4
- **PHP Path:** `php8.5` (added to environment variables)
- **Platform:** Windows (win32)

### Installation

```bash
# Create project
php8.5 "D:/ProgramFiles/LocalServer/laragon/bin/composer/composer.phar" create-project laravel/laravel digiorb-be --prefer-dist

# Install dependencies
php8.5 "D:/ProgramFiles/LocalServer/laragon/bin/composer/composer.phar" install

# Generate app key
php8.5 artisan key:generate

# Run migrations
php8.5 artisan migrate

# Seed data
php8.5 artisan db:seed

# Run development server
php8.5 artisan serve
```

### Database Configuration
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=digiorb
DB_USERNAME=root
DB_PASSWORD=
```

### Versions
- **Laravel Framework:** 13.2.0
- **PHP Required:** ^8.2

## Packages Installed

- **Livewire:** 4.2.2
- **Tailwind CSS:** 4.2.2 (via `@tailwindcss/vite`)

## Useful Commands

```bash
# List routes
php8.5 artisan route:list

# Clear cache
php8.5 artisan cache:clear
php8.5 artisan config:clear
php8.5 artisan route:clear

# Build frontend assets
npm run build
npm run dev
```

## API Documentation

See [feature.md](./feature.md) for full API documentation.
