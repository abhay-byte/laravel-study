# Learning Laravel: Configuration & Environment
**[< Previous: Database](08-database.md) | [Next: Deep Dive: Database Drivers >](10-database-drivers-deep-dive.md)**
Setup

## 1. The .env File
Laravel uses the [DotEnv](https://github.com/vlucas/phpdotenv) library. The root directory of your application will contain a `.env.example` file. You should copy this to `.env` manually or running `cp .env.example .env`.

### Important Keys
- `APP_ENV`: usually `local` or `production`.
- `APP_KEY`: A 32-character string used for encryption. Run `php artisan key:generate` to set this.
- `APP_DEBUG`: Set to `true` in development to see detailed errors. Set to `false` in production.
- `DB_Connection`: Credentials for your database.

**Security Note**: NEVER commit your `.env` file to source control.

## 2. Server Management

### Starting the Local Server
Laravel includes a built-in development server.
```bash
php artisan serve
```
This will start a server at `http://127.0.0.1:8000`.

### Stopping the Server
Press `Ctrl + C` in the terminal where the server is running.

## 3. Database Setup (MySQL)
Before you run `php artisan migrate`, you must create the database.

### Using Command Line
1. Login to MySQL:
   ```bash
   mysql -u root -p
   ```
2. Create Database:
   ```sql
   CREATE DATABASE laravel_app;
   ```
3. Create User & Grant Privileges (Optional but Recommended):
   ```sql
   CREATE USER 'laravel_user'@'localhost' IDENTIFIED BY 'secret_password';
   GRANT ALL PRIVILEGES ON laravel_app.* TO 'laravel_user'@'localhost';
   FLUSH PRIVILEGES;
   EXIT;
   ```
4. Update `.env`:
   ```ini
   DB_DATABASE=laravel_app
   DB_USERNAME=laravel_user
   DB_PASSWORD=secret_password
   ```
