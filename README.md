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

## Learning Path 📚

Follow these guides in order to understand how this project was built:

### Phase 1: Laravel Basics
1.  [Introduction](01-intro.md)
2.  [Architecture & Concepts](02-architecture.md)
3.  [Installation](03-installation.md)
4.  [Routes](04-routes.md)
5.  [Controllers](05-controllers.md)
6.  [Middleware](06-middleware.md)
7.  [Services](07-services.md)
8.  [Database & Eloquent](08-database.md)
9.  [Configuration](09-configuration.md)
10. [Deep Dive: Database Drivers](10-database-drivers-deep-dive.md)

### Phase 2: React Frontend
11. [React Setup & Initialization](11-react-initialization.md)
12. [React Routing](12-react-routing.md)
13. [Auth Context](13-react-auth-context.md)
14. [Auth Pages (Login/Register)](14-react-auth-pages.md)
15. [CRUD Endpoints](15-react-crud-endpoints.md)
16. [Components & Hooks](16-react-components-and-hooks.md)

### Phase 3: Raw PHP vs Laravel
17. [Raw PHP Backend Impl.](17-raw-php-backend.md)

## Documentation

- [Database Schema & ERD](docs/database_schema.md)
- [Architecture & Components](docs/architecture_components.md)
