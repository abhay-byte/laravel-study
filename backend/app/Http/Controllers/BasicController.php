<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GreetingService;

/**
 * --------------------------------------------------------------------------
 * Basic Controller (The Chef)
 * --------------------------------------------------------------------------
 * 
 * The Controller is the "Chef" in the kitchen. 
 * It receives the order from the waiter (Route), does the work (cooking), 
 * and gives the result (food) back to the customer.
 * 
 */
class BasicController extends Controller
{
    /**
     * Handle the GET /hello request.
     * Returns all orders from the database.
     */
    public function sayHello(Request $request)
    {
        // Fetch valid user orders
        return $request->user()->orders;
    }

    /**
     * Handle the POST /submit-order request.
     * Creates a new order in the database.
     */
    public function createOrder(Request $request)
    {
        $request->validate(['item' => 'required|string']);

        // Create a new order record for the user
        $order = $request->user()->orders()->create([
            'name' => $request->input('item')
        ]);

        return $order;
    }

    /**
     * Handle the PUT /update-order/{id} request.
     * Updates an existing order.
     */
    public function updateOrder(Request $request, $id)
    {
        $order = $request->user()->orders()->find($id);

        if (!$order) {
            return response()->json(['message' => 'Order not found or unauthorized'], 404);
        }

        // Update the order name if provided, otherwise append " (Updated)"
        $newName = $request->input('item', $order->name . ' (Updated)');
        
        $order->update(['name' => $newName]);

        return $order;
    }

    /**
     * Handle the DELETE /cancel-order/{id} request.
     * Deletes an order from the database.
     */
    public function deleteOrder(Request $request, $id)
    {
        $order = $request->user()->orders()->find($id);

        if (!$order) {
            return response()->json(['message' => 'Order not found or unauthorized'], 404);
        }

        $order->delete();

        return response()->json(['message' => 'Order deleted successfully']);
    }
}
