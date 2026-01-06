# Learning Laravel: Controllers

Instead of defining all of your request handling logic as closures in your route files, you may wish to organize this behavior using "controller" classes. Controllers can group related request handling logic into a single class.

## Basic Controller
Controllers are stored in the `app/Http/Controllers` directory.

```php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Show the profile for a given user.
     */
    public function show(string $id): View
    {
        return view('user.profile', [
            'user' => User::findOrFail($id)
        ]);
    }
}
```

## Routing to Controllers

```php
use App\Http\Controllers\UserController;

Route::get('/user/{id}', [UserController::class, 'show']);
```

## Resource Controllers
Laravel resource routing assigns the typical "CRUD" routes to a controller with a single line of code.

```bash
php artisan make:controller PhotoController --resource
```

This command will create a controller with methods for `index`, `create`, `store`, `show`, `edit`, `update`, and `destroy`.

Route registration:
```php
Route::resource('photos', PhotoController::class);
```

## Dependency Injection
The Laravel service container is used to resolve all Laravel controllers. As a result, you are able to type-hint any dependencies your controller may need in its constructor or update methods.

```php
    public function __construct(
        protected UserRepository $users,
    ) {}
}

## Accessing Authenticated User
When using authentication (like Sanctum), you can access the currently authenticated user via the request object. This is useful for scoping data to the specific user.

```php
public function createOrder(Request $request)
{
    // Automatically link the new order to the authenticated user
    // Assumes a 'orders' relationship exists on the User model
    return $request->user()->orders()->create([
        'name' => $request->input('item')
    ]);
}
```
```
