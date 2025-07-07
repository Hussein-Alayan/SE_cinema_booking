<?php
require_once(__DIR__ . "/../connection/config.php");

$query = "INSERT INTO users (first_name, last_name, email, mobile, password_hash, date_of_birth, created_at) VALUES 
('Admin', 'User', 'admin@cinema.com', '1234567890', '" . password_hash('admin123', PASSWORD_DEFAULT) . "', '1990-01-01', NOW()),
('John', 'Doe', 'john@example.com', '1234567891', '" . password_hash('password123', PASSWORD_DEFAULT) . "', '1995-05-15', NOW()),
('Jane', 'Smith', 'jane@example.com', '1234567892', '" . password_hash('password123', PASSWORD_DEFAULT) . "', '1992-08-20', NOW())";

$execute = $mysqli->prepare($query);
$execute->execute();

echo "Users seeded successfully!";
