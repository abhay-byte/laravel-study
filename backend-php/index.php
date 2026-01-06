<?php
// Handle CORS manually
$origin = $_SERVER['HTTP_ORIGIN'] ?? '';
$allowed_origins = ['http://localhost:5173', 'http://127.0.0.1:5173'];

if (in_array($origin, $allowed_origins)) {
    header("Access-Control-Allow-Origin: $origin");
    header("Access-Control-Allow-Credentials: true");
}

header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Content-Type: application/json");

// Handle preflight requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

require_once 'api.php';

// Simple Router (Switch statement instead of Laravel Routes)
$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

// Remove query strings for matching
$uri = strtok($uri, '?');



// Helper: Extract User ID from Token
function getUserId() {
    $headers = getallheaders();
    $authHeader = $headers['Authorization'] ?? $headers['authorization'] ?? '';
    
    // Check for Bearer token
    if (preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
        $token = $matches[1];
        $userId = validateToken($token);
        
        if ($userId) {
            return $userId;
        }
    }
    
    http_response_code(401);
    echo json_encode(['message' => 'Unauthenticated']);
    exit;
}

// Route matching
if ($uri === '/api/hello' && $method === 'GET') {
    $userId = getUserId();
    $orders = getOrders($userId);
    echo json_encode($orders);
}
elseif ($uri === '/api/submit-order' && $method === 'POST') {
    $userId = getUserId();
    $input = json_decode(file_get_contents('php://input'), true);
    $response = createOrder($userId, $input);
    echo json_encode($response);
}
// Handle Update
elseif (preg_match('#^/api/update-order/(\d+)$#', $uri, $matches) && $method === 'PUT') {
    $userId = getUserId();
    $id = $matches[1];
    $input = json_decode(file_get_contents('php://input'), true);
    $response = updateOrder($userId, $id, $input);
    echo json_encode($response);
}
// Handle Delete
elseif (preg_match('#^/api/cancel-order/(\d+)$#', $uri, $matches) && $method === 'DELETE') {
    $userId = getUserId();
    $id = $matches[1];
    $response = deleteOrder($userId, $id);
    echo json_encode($response);
}
// --- Real Auth Routes ---
elseif ($uri === '/api/login' && $method === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    $result = login($input);
    
    if (isset($result['error']) || isset($result['message'])) {
        echo json_encode($result); // Error code already set in function
    } else {
        echo json_encode($result);
    }
}
elseif ($uri === '/api/register' && $method === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    $result = register($input);

    if (isset($result['error'])) {
        echo json_encode($result);
    } else {
        echo json_encode($result);
    }
}
elseif ($uri === '/api/logout' && $method === 'POST') {
    // Ideally we should delete the token from raw_tokens here
    echo json_encode(['message' => 'Logged out']);
}
elseif ($uri === '/api/user' && $method === 'GET') {
    $userId = getUserId(); // This auto-validates token or exits 401
    echo json_encode(getUser($userId));
} 
else {
    http_response_code(404);
    echo json_encode(['message' => 'Not Found']);
}
