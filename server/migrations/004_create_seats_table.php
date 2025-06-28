<?php
require("../connection/config.php");

$query = "CREATE TABLE IF NOT EXISTS seats (
    id INT AUTO_INCREMENT PRIMARY KEY,
    auditorium_id INT NOT NULL,
    row_label CHAR(1) NOT NULL,
    seat_number SMALLINT NOT NULL,
    UNIQUE KEY unique_seat (auditorium_id, row_label, seat_number),
    FOREIGN KEY (auditorium_id) REFERENCES auditoriums(id) ON DELETE CASCADE
)";

$execute = $mysqli->prepare($query);
$execute->execute();
