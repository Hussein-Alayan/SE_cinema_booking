<?php
require("../connection/config.php");

$query = "CREATE TABLE IF NOT EXISTS auditoriums (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    total_seats SMALLINT NOT NULL
);";

$execute = $mysqli->prepare($query);
$execute->execute();
