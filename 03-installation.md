# Laravel 11 Installation Guide

**[< Previous: Architecture](02-architecture.md) | [Next: Routes >](04-routes.md)**

This guide covers installing Laravel 11 on **Debian 12** and **Arch Linux**.

## 1. Install Prerequisites (PHP & Composer)

Laravel 11 requires PHP >= 8.2 and Composer.

### Option A: Debian 12 (Bookworm)
Debian 12 ships with a recent version of PHP, making installation straightforward.

```bash
# 1. Update system
sudo apt update && sudo apt upgrade -y

# 2. Install PHP and required extensions
sudo apt install -y php php-cli php-common php-mysql php-zip php-gd php-mbstring php-curl php-xml php-bcmath

# 3. Check PHP version
php -v
# Output should show PHP 8.2 or higher

# 4. Install Composer
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php composer-setup.php --install-dir=/usr/local/bin --filename=composer
php -r "unlink('composer-setup.php');"

# 5. Verify Composer
composer --version
```

### Option B: Arch Linux
Arch Linux always has the latest packages.

```bash
# 1. Update system
sudo pacman -Syu

# 2. Install PHP and Composer
sudo pacman -S php php-sqlite composer

# 3. Enable extensions in php.ini
# You need to uncomment extension lines in /etc/php/php.ini
# Run this command to quickly enable common extensions:
sudo sed -i 's/;extension=zip/extension=zip/' /etc/php/php.ini && \
sudo sed -i 's/;extension=gd/extension=gd/' /etc/php/php.ini && \
sudo sed -i 's/;extension=pdo_mysql/extension=pdo_mysql/' /etc/php/php.ini && \
sudo sed -i 's/;extension=mysqli/extension=mysqli/' /etc/php/php.ini && \
sudo sed -i 's/;extension=sqlite3/extension=sqlite3/' /etc/php/php.ini && \
sudo sed -i 's/;extension=pdo_sqlite/extension=pdo_sqlite/' /etc/php/php.ini && \
sudo sed -i 's/;extension=fileinfo/extension=fileinfo/' /etc/php/php.ini
```

### Understanding these Extensions
Here is why Laravel needs these specific modules:

| Extension | Purpose |
| :--- | :--- |
| **zip** | Required by Composer to unzip packages and manage dependencies. |
| **gd** | Used for image processing (resizing, cropping) if you use libraries like Intervention Image. |
| **pdo_mysql** | The driver that allows PHP to talk to **MySQL** databases. |
| **mysqli** | An alternative MySQL driver (sometimes required by specific tools). |
| **sqlite3** | The driver for **SQLite** databases (simple, file-based databases). |
| **pdo_sqlite** | The PDO wrapper for SQLite, used by Laravel's Eloquent ORM. |
| **fileinfo** | Used to detect the "MIME type" of uploaded files (e.g., checking if a file is actually a JPG). |

## 2. Create a Laravel Project

Once PHP and Composer are installed, you can create a new project.

### Method 1: Via Composer (Recommended for single projects)
```bash
composer create-project laravel/laravel:^11.0 my-app
cd my-app
```

### Method 2: Via Laravel Installer (Global)
```bash
composer global require laravel/installer
laravel new my-app
```

## 3. Post-Installation Setup

### Directory Permissions
If you are on Linux, you may need to ensure the web server can write to certain directories if you are serving via Apache/Nginx (not needed for `php artisan serve`).

```bash
sudo chown -R www-data:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache
```

### Start Development Server
```bash
php artisan serve
```
Visit `http://localhost:8000` to see your new application.
