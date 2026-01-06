# Learning Laravel: Services & Design Patterns

Laravel doesn't have a specific "Service" directory by default, but using Service classes is a standard best practice for keeping your Controllers "thin".

## What is a Service?
A Service is a plain PHP class that holds business logic. 
- **Controller's Job**: Receive request, validate input, ask Service to do work, return response.
- **Service's Job**: Perform the complex work (calculate taxes, process payment, generate PDF).

## Creating a Service

1. Create a `Services` directory in `app/`.
2. Create your class (e.g., `PaymentService.php`).

```php
namespace App\Services;

class PaymentService
{
    public function process($amount, $currency)
    {
        // Complex logic here...
        return true;
    }
}
```

## Using a Service (Dependency Injection)

You can inject this service into any Controller.

```php
use App\Services\PaymentService;

class CheckoutController extends Controller
{
    public function __construct(
        protected PaymentService $payments
    ) {}

    public function store()
    {
        $this->payments->process(100, 'USD');
    }
}
```

## Why do this?
1.  **Reusability**: You can use the `PaymentService` in a Controller, a Console Command, or a Job without rewriting code.
2.  **Testing**: It is much easier to write unit tests for a plain Service class than for a Controller.
