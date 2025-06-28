<?php
// Test file to demonstrate the hybrid approach
require_once("connection/config.php");
require_once("models/Model.php");
require_once("models/User.php");
require_once("models/Movie.php");

// Set up database connection
Model::setConnection($mysqli);

echo "=== Testing Hybrid Model Approach ===\n\n";

// Test 1: Create a user using array-based approach
echo "1. Creating user with array-based approach:\n";
$userData = [
    'first_name' => 'John',
    'last_name' => 'Doe',
    'email' => 'john@example.com',
    'mobile' => '1234567890',
    'password_hash' => password_hash('password123', PASSWORD_DEFAULT),
    'date_of_birth' => '1990-01-01'
];

try {
    $user = User::create($userData);
    echo "   ✅ User created with ID: " . $user->getId() . "\n";
    echo "   Email: " . $user->getEmail() . "\n";
    echo "   Array access: " . $user->get('email') . "\n\n";
} catch (Exception $e) {
    echo "   ❌ Error: " . $e->getMessage() . "\n\n";
}

// Test 2: Find user and use both approaches
echo "2. Finding user and testing both access methods:\n";
try {
    $foundUser = User::find($user->getId());
    if ($foundUser) {
        echo "   ✅ User found!\n";
        echo "   Property access - First Name: " . $foundUser->getFirstName() . "\n";
        echo "   Array access - First Name: " . $foundUser->get('first_name') . "\n";
        echo "   Property access - Last Name: " . $foundUser->getLastName() . "\n";
        echo "   Array access - Last Name: " . $foundUser->get('last_name') . "\n\n";
    }
} catch (Exception $e) {
    echo "   ❌ Error: " . $e->getMessage() . "\n\n";
}

// Test 3: Update using property setters
echo "3. Updating user with property setters:\n";
try {
    $foundUser->setFirstName('Jane');
    $foundUser->setEmail('jane@example.com');
    $foundUser->update();
    echo "   ✅ User updated successfully!\n";
    echo "   New First Name: " . $foundUser->getFirstName() . "\n";
    echo "   New Email: " . $foundUser->getEmail() . "\n\n";
} catch (Exception $e) {
    echo "   ❌ Error: " . $e->getMessage() . "\n\n";
}

// Test 4: Update using array setters
echo "4. Updating user with array setters:\n";
try {
    $foundUser->set('last_name', 'Smith');
    $foundUser->set('mobile', '9876543210');
    $foundUser->update();
    echo "   ✅ User updated successfully!\n";
    echo "   New Last Name: " . $foundUser->getLastName() . "\n";
    echo "   New Mobile: " . $foundUser->getMobile() . "\n\n";
} catch (Exception $e) {
    echo "   ❌ Error: " . $e->getMessage() . "\n\n";
}

echo "=== Test Complete ===\n";
echo "Both property-based and array-based approaches work seamlessly!\n";
