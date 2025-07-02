<?php
require_once("../../bootstrap.php");

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit;
}

try {
    $input = json_decode(file_get_contents('php://input'), true) ?: $_POST;
    $email = $input['email'] ?? null;
    $password = $input['password'] ?? null;

    if (!$email || !$password) {
        http_response_code(400);
        echo json_encode(['error' => 'Email and password are required']);
        exit;
    }

    $user = User::findByEmailOrMobile($email);
    if (!$user || !$user->verifyPassword($password)) {
        http_response_code(401);
        echo json_encode(['error' => 'Invalid email or password']);
        exit;
    }

    echo json_encode([
        'success' => true,
        'message' => 'Login successful',
        'user' => $user->toArray()
    ]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
