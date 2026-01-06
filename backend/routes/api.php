<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BasicController;

// Public Routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected Routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    
    // Orders CRUD (Moved from web.php)
    Route::get('/hello', [BasicController::class, 'sayHello']); // This was our "List Orders"
    Route::post('/submit-order', [BasicController::class, 'createOrder']);
    Route::put('/update-order/{id}', [BasicController::class, 'updateOrder']);
    Route::delete('/cancel-order/{id}', [BasicController::class, 'deleteOrder']);
});

