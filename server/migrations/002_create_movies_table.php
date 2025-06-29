<?php
require("../connection/config.php");

$query = "CREATE TABLE IF NOT EXISTS movies (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    rating ENUM('G', 'PG', 'PG-13', 'R', 'NC-17') DEFAULT 'PG-13',
    duration_minutes SMALLINT NOT NULL,
    release_date DATE,
    trailer_url VARCHAR(500),
    description TEXT,
    poster_url VARCHAR(500),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

$execute = $mysqli->prepare($query);
$execute->execute();
