<?php
require_once("../../bootstrap.php");

header('Content-Type: application/json'); //ensure json is returned 

if ($_SERVER['REQUEST_METHOD'] !== 'POST') { // error if post request is not made
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit;
}

try {
    $input = json_decode(file_get_contents('php://input'), true) ?: $_POST;

    //password into hashpassword
    if (isset($input['password'])) {
        $input['password_hash'] = password_hash($input['password'], PASSWORD_DEFAULT);
        unset($input['password']); // Remove plain password
    }
    $user = User::create($input);

    // Return success with toArray()
    http_response_code(201);
    echo json_encode([
        'success' => true,
        'message' => 'User created successfully',
        'user' => $user->toArray()
    ]);
} catch (ValidationException $e) {
    http_response_code(400);
    echo json_encode(['error' => $e->getMessage()]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
