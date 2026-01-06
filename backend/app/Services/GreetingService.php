<?php

namespace App\Services;

/**
 * --------------------------------------------------------------------------
 * Greeting Service (The Specialist Helper)
 * --------------------------------------------------------------------------
 * 
 * A Service is like a SPECIALIST HELPER to the Chef (Controller).
 * If the Chef has to do something complicated (like calculating a tax, or sending 
 * an email, or formatting a nice message), they ask the Helper to do it.
 * 
 * Why? strict separation of concerns. The Chef should just manage orders, 
 * not chop every single onion themselves.
 * 
 */
class GreetingService
{
    /**
     * Create a nice greeting message.
     * 
     * @param string $name
     * @return string
     */
    public function greet($name)
    {
        // The business logic happens here.
        // We can change this logic later (e.g., add "Good Morning") 
        // without touching the Controller.
        
        return "Hello, " . $name . "! Welcome to the backend.";
    }
}
