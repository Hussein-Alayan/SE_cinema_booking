<?php
require(__DIR__ . '/../connection/config.php');

$query = "CREATE TABLE IF NOT EXISTS auditoriums (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    layout TEXT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

$execute = $mysqli->prepare($query);
$execute->execute();
