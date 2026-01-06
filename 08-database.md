# Learning Laravel:# Database & Eloquent ORM

**[< Previous: Services](07-services.md) | [Next: Configuration >](09-configuration.md)**

Laravel makes interacting with databases extremely easy across a variety of supported backends (MySQL, PostgreSQL, SQLite, etc.).

## 1. Migrations
Migrations are like version control for your database, allowing your team to define and share the application's database schema definition.

### Creating a Migration
```bash
php artisan make:migration create_flights_table
```

### migration Structure
```php
public function up(): void
{
    Schema::create('flights', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('airline');
        $table->timestamps();
    });
}
```

### Running Migrations
```bash
php artisan migrate
```

## 2. Eloquent ORM
Eloquent includes a simple "active record" implementation for working with your database. Each database table has a corresponding "Model".

### Defining a Model
```bash
php artisan make:model Flight
```

### Retrieving Data
```php
use App\Models\Flight;

// Get all flights
$flights = Flight::all();

// Find by Primary Key
$flight = Flight::find(1);

// Query constraints
$flights = Flight::where('active', 1)->orderBy('name')->take(10)->get();
```

### Inserting & Updating
```php
// Insert
$flight = new Flight;
$flight->name = 'Tokyo to London';
$flight->save();

// Update
$flight = Flight::find(1);
$flight->name = 'Paris to London';
$flight->save();
```

### Deleting
```php
$flight = Flight::find(1);
$flight->delete();
```

## 3. Relationships & Foreign Keys
Tables often relate to one another. For example, an `Order` belongs to a `User`.

### Migration with Foreign Key
```php
Schema::table('orders', function (Blueprint $table) {
    $table->foreignId('user_id')->constrained()->cascadeOnDelete();
});
```

### Defining Relationships
**User Model (One-to-Many):**
```php
public function orders()
{
    return $this->hasMany(Order::class);
}
```

**Order Model (Many-to-One):**
```php
public function user()
{
    return $this->belongsTo(User::class);
}
```
```
