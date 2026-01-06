<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * --------------------------------------------------------------------------
 * CheckAge Middleware (The Security Guard)
 * --------------------------------------------------------------------------
 * 
 * Middleware is like a SECURITY GUARD at the door of a club.
 * Before you can go inside (reach the Controller), the guard checks your ID.
 * 
 */
class CheckAge
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request  The person trying to enter.
     * @param  \Closure  $next  The next step (letting them in).
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // 1. The Guard inspects the visitor
        // We check if the 'age' they told us is less than 5.
        // URL: http://website.com/hello?age=3
        
        if ($request->input('age') < 5) {
            
            // IF: Too young
            // Action: Turn them away.
            return "Sorry, you are too young to enter this site.";
        }

        // 2. The Guard opens the door
        // IF: Old enough
        // Action: Let them go to the next step (The Controller/Chef).
        return $next($request);
    }
}
