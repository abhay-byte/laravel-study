# Learning Laravel: Routes

Routes are the entry points of your application. They define how your application responds to specific URLs and HTTP methods.

## Basic Routing
All web routes are defined in `routes/web.php`.

```php
// Basic GET route
Route::get('/greeting', function () {
    return 'Hello World';
});
```

## Available Router Methods
The router allows you to register routes that respond to any HTTP verb:

```php
Route::get($uri, $callback);
Route::post($uri, $callback);
Route::put($uri, $callback);
Route::patch($uri, $callback);
Route::delete($uri, $callback);
Route::options($uri, $callback);
```

## Route Parameters

### Required Parameters
Capture segments of the URI within your route.

```php
Route::get('/user/{id}', function (string $id) {
    return 'User '.$id;
});
```

### Optional Parameters
Make a parameter optional by placing a `?` mark after the parameter name.

```php
Route::get('/user/{name?}', function (?string $name = 'Guest') {
    return $name;
});
```

## Named Routes
Named routes allow the convenient generation of URLs or redirects for specific routes.

```php
Route::get('/user/profile', function () {
    // ...
})->name('profile');

// Generating URLs...
$url = route('profile');

// Generating Redirects...
return redirect()->route('profile');
```

## Route Groups
Route groups allow you to share route attributes, such as middleware or namespaces, across a large number of routes without needing to define those attributes on each individual route.

```php
    Route::get('/account', function () {
        // Uses Auth middleware
    });
});

## API Routes & Authentication
API routes are defined in `routes/api.php`. These routes are stateless and are assigned the `api` middleware group.

To protect API# Routes in Laravel

**[< Previous: Installation](03-installation.md) | [Next: Controllers >](05-controllers.md)**
 Sanctum:

```php
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('/logout', [AuthController::class, 'logout']);
});
```
```
