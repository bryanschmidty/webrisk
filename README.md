# WebRisk Rewrite

The original PHP codebase has been moved to `legacy/` for reference.
A fresh Laravel application now lives in the project root.

## Getting Started

1. Copy `.env.example` to `.env` and adjust the database settings:
   ```
   DB_CONNECTION=mysql
   DB_HOST=localhost
   DB_PORT=3306
   DB_DATABASE=database_here
   DB_USERNAME=username_here
   DB_PASSWORD=password_here
   ```
2. Install PHP dependencies with Composer:
   `composer install`
3. Generate an application key and run migrations:
   ```
   php artisan key:generate
   php artisan migrate
   ```

This will set up an empty game database ready for development.
