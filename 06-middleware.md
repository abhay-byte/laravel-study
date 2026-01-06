# Learning Laravel: Middleware

Middleware provide a convenient mechanism for inspecting and filtering HTTP requests entering your application.

## Defining Middleware
To create a new middleware, use the `make:middleware` Artisan command:

```bash
php artisan make:middleware EnsureTokenIsValid
```

This class will be placed within your `app/Http/Middleware` directory.

```php
public function handle(Request $request, Closure $next): Response
{
    if ($request->input('token') !== 'my-secret-token') {
        return redirect('home');
    }

    return $next($request);
}
```

## Registering Middleware

### Global Middleware
If you want a middleware to run during every single HTTP request to your application, you should append it in the `bootstrap/app.php` file (in Laravel 11).

### Assigning Middleware to Routes
If you would like to assign middleware to specific routes, you can define it when creating the route:

```php
use App\Http\Middleware\EnsureTokenIsValid;

Route::get('/profile', function () {
    // ...
})->middleware(EnsureTokenIsValid::class);
```

### Middleware Groups
Sometimes you may want to group several middleware under a single key to make them easier to assign to routes.

```php
Route::middleware(['web'])->group(function () {
    // ...
});

### Sanctum Authentication
For API authentication, Laravel Sanctum provides the `auth:sanctum` middleware. This ensures that the incoming request has a valid Bearer token.

```php
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
```
```
