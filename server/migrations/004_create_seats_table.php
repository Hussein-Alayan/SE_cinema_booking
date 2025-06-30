<?php
require(__DIR__ . '/../connection/config.php');

$query = "CREATE TABLE IF NOT EXISTS seats (
    id INT AUTO_INCREMENT PRIMARY KEY,
    auditorium_id INT NOT NULL,
    row VARCHAR(10) NOT NULL,
    number INT NOT NULL,
    type VARCHAR(50) DEFAULT 'standard',
    status VARCHAR(20) DEFAULT 'available',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (auditorium_id) REFERENCES auditoriums(id) ON DELETE CASCADE
)";

$execute = $mysqli->prepare($query);
$execute->execute();
