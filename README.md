# Laravel Study Project 🚀

A comprehensive learning project demonstrating a full-stack web application with **Laravel 11**, **React**, and a comparative **Raw PHP** backend.

## Project Structure

- **`backend/`**: Laravel 11 API (The "Main" Backend)
- **`frontend/`**: React + Vite (The Frontend)
- **`backend-php/`**: Raw PHP Implementation (The "Hard Way" Demo)
- **`docs/`**: Project Documentation (Schema, Architecture)
- **`*.md`**: Learning notes and guides created during the study.

## Features

- **Authentication**: Full-stack auth using Laravel Sanctum (cookies).
- **CRUD**: Complete Order Management (Create, Read, Update, Delete).
- **User Scoping**: Users can only see and manage their own orders.
- **Comparison**: Includes a raw PHP backend to contrast with Laravel's elegance.

## Getting Started

### 1. Prerequisites
- PHP 8.2+
- Composer
- Node.js & npm
- SQLite

### 2. Laravel Backend Setup
```bash
cd backend
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate
php artisan serve
```
Runs on: `http://localhost:8000`

### 3. React Frontend Setup
```bash
cd frontend
npm install
npm run dev
```
Runs on: `http://localhost:5173`

### 4. Raw PHP Backend (Optional)
To test the "Raw PHP" implementation:
1.  Stop the Laravel server.
2.  Run the PHP server:
    ```bash
    cd backend-php
    php -S localhost:8001
    ```
3.  Update `frontend/src/api.js` to port `8001`.

## Documentation

- [Database Schema & ERD](docs/database_schema.md)
- [Architecture & Components](docs/architecture_components.md)
- [Raw PHP Backend Details](17-raw-php-backend.md)
