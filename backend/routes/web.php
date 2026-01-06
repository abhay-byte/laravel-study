<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BasicController;

/**
 * --------------------------------------------------------------------------
 * Web Routes (The Map)
 * --------------------------------------------------------------------------
 * 
 * Imagine this file is like a MENU in a restaurant. 
 * When a user (customer) asks for something, this file tells the application 
 * (the kitchen) which "Chef" (Controller) should handle the order.
 *
 */

// 1. GET Request
// Definition: "Can I see this page?"
// Analogy: asking a waiter for the menu. You just want to LOOK at something.
Route::get('/', function () {
    return 'Welcome to our restaurant!';
});

// Using a Controller (The Chef)
// Here we say: "When user goes to /hello, ask the BasicController to use the 'sayHello' method."
Route::get('/hello', [BasicController::class, 'sayHello']);


// 2. POST Request
// Definition: "I want to give you new information."
// Analogy: Giving the waiter your written order. You are SENDING data to the kitchen.
Route::post('/submit-order', [BasicController::class, 'createOrder']);


// 3. PUT Request
// Definition: "I want to update something that already exists."
// Analogy: "Actually, can I change my order? I want salad instead of soup."
Route::put('/update-order/{id}', [BasicController::class, 'updateOrder']);


// 4. DELETE Request
// Definition: "I want to remove something."
// Analogy: "Cancel my order, please."
Route::delete('/cancel-order/{id}', [BasicController::class, 'deleteOrder']);
