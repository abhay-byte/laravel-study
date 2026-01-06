# Learning:# Raw PHP Backend Demo

**[< Previous: Components & Hooks](16-react-components-and-hooks.md) | [Back to README](README.md)**

This directory (`backend-php`) contains a "Framework-less" implementation of our API to demonstrate the difference between raw PHP and Laravel.

## 1. Structure Comparison

| Feature | Laravel (`backend`) | Raw PHP (`backend-php`) |
| :--- | :--- | :--- |
| **Routing** | `routes/api.php` (Clean, Expressive) | `index.php` (Manual `if/else` or `switch`) |
| **Database** | Eloquent ORM (`Order::all()`) | Raw PDO (`SELECT * FROM orders`) |
| **Security** | Built-in (Validation, CSRF, Sanctum) | Manual (Input validation, Token parsing) |
| **CORS** | Configurable Middleware | Manual Headers (`header('Access-Control...')`) |

## 2. Key Files

### `index.php` (The Entry Point)
Handles routing and CORS headers manually.

```php
// Manual CORS
header("Access-Control-Allow-Origin: *");

// Manual Routing
if ($uri === '/api/hello' && $method === 'GET') {
    // ...
}
```

### `db.php` (Database Connection)
Manually creates a PDO instance.

```php
$pdo = new PDO('sqlite:../backend/database/database.sqlite');
```

### `api.php` (Logic)
Contains the actual function logic that a Controller would otherwise handle.

## 3. How to Run

To test this backend, you can run the built-in PHP server inside the `backend-php` directory:

```bash
cd backend-php
php -S localhost:8001
```

You can then modify `frontend/src/api.js` to point to port `8001` to test it with your frontend!
