<?php
require_once 'db.php';

function getOrders($userId) {
    $pdo = getDbConnection();
    // Filter by user_id
    $stmt = $pdo->prepare("SELECT * FROM orders WHERE user_id = ?");
    $stmt->execute([$userId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function createOrder($userId, $data) {
    if (!isset($data['item']) || empty($data['item'])) {
        http_response_code(422);
        return ['error' => 'Item name is required'];
    }

    $pdo = getDbConnection();
    $stmt = $pdo->prepare("INSERT INTO orders (user_id, name, created_at, updated_at) VALUES (:user_id, :name, :now, :now)");
    
    $now = date('Y-m-d H:i:s');
    $stmt->execute([
        ':user_id' => $userId,
        ':name' => $data['item'],
        ':now' => $now
    ]);

    return [
        'id' => $pdo->lastInsertId(),
        'user_id' => $userId,
        'name' => $data['item'],
        'created_at' => $now,
        'updated_at' => $now
    ];
}

function updateOrder($userId, $id, $data) {
    if (!isset($data['item']) || empty($data['item'])) {
        http_response_code(422);
        return ['error' => 'Item name is required'];
    }

    $pdo = getDbConnection();
    // Verify ownership
    $stmt = $pdo->prepare("UPDATE orders SET name = :name, updated_at = :now WHERE id = :id AND user_id = :user_id");
    
    $now = date('Y-m-d H:i:s');
    $stmt->execute([
        ':name' => $data['item'],
        ':now' => $now,
        ':id' => $id,
        ':user_id' => $userId
    ]);

    if ($stmt->rowCount() === 0) {
        http_response_code(404);
        return ['error' => 'Order not found or unauthorized'];
    }

    // Fetch updated order
    $stmt = $pdo->prepare("SELECT * FROM orders WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function deleteOrder($userId, $id) {
    $pdo = getDbConnection();
    $stmt = $pdo->prepare("DELETE FROM orders WHERE id = ? AND user_id = ?");
    $stmt->execute([$id, $userId]);
    
    if ($stmt->rowCount() === 0) {
        http_response_code(404);
        return ['error' => 'Order not found or unauthorized'];
    }

    return ['message' => 'Order deleted successfully'];
}

// --- Real Auth ---

function generateToken() {
    return bin2hex(random_bytes(32));
}

function login($data) {
    if (!isset($data['email']) || !isset($data['password'])) {
        http_response_code(422);
        return ['error' => 'Email and password required'];
    }

    $pdo = getDbConnection();
    // 1. Find user
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$data['email']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // 2. Verify password
    if (!$user || !password_verify($data['password'], $user['password'])) {
        http_response_code(401);
        return ['message' => 'Invalid credentials'];
    }

    // 3. Create Token
    $token = generateToken();
    $stmt = $pdo->prepare("INSERT INTO raw_tokens (token, user_id) VALUES (?, ?)");
    $stmt->execute([$token, $user['id']]);

    return [
        'user' => $user,
        'token' => $token
    ];
}

function register($data) {
    if (!isset($data['name']) || !isset($data['email']) || !isset($data['password'])) {
        http_response_code(422);
        return ['error' => 'Name, email, and password required'];
    }

    $pdo = getDbConnection();
    
    // 1. Check if email exists
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$data['email']]);
    if ($stmt->fetch()) {
        http_response_code(422);
        return ['error' => 'Email already exists'];
    }

    // 2. Hash password & Create User
    $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
    $now = date('Y-m-d H:i:s');
    
    $stmt = $pdo->prepare("INSERT INTO users (name, email, password, created_at, updated_at) VALUES (:name, :email, :password, :now, :now)");
    $stmt->execute([
        ':name' => $data['name'],
        ':email' => $data['email'],
        ':password' => $hashedPassword,
        ':now' => $now
    ]);
    
    $userId = $pdo->lastInsertId();
    $user = ['id' => $userId, 'name' => $data['name'], 'email' => $data['email']];

    // 3. Create Token
    $token = generateToken();
    $stmt = $pdo->prepare("INSERT INTO raw_tokens (token, user_id) VALUES (?, ?)");
    $stmt->execute([$token, $userId]);

    return [
        'user' => $user,
        'token' => $token
    ];
}

function validateToken($token) {
    $pdo = getDbConnection();
    $stmt = $pdo->prepare("SELECT user_id FROM raw_tokens WHERE token = ?");
    $stmt->execute([$token]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    return $result ? $result['user_id'] : null;
}

function getUser($userId) {
    $pdo = getDbConnection();
    $stmt = $pdo->prepare("SELECT id, name, email FROM users WHERE id = ?");
    $stmt->execute([$userId]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
