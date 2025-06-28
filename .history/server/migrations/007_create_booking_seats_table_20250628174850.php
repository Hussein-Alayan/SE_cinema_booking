<?php
require("../connection/config.php");

$query = "CREATE TABLE IF NOT EXISTS booking_seats (
    id INT AUTO_INCREMENT PRIMARY KEY,
    booking_id INT NOT NULL,
    seat_id INT NOT NULL,
    price_paid DECIMAL(6,2) NOT NULL,
    UNIQUE KEY unique_booking_seat (booking_id, seat_id),
    FOREIGN KEY (booking_id) REFERENCES bookings(id) ON DELETE CASCADE,
    FOREIGN KEY (seat_id) REFERENCES seats(id) ON DELETE CASCADE
)";

$execute = $mysqli->prepare($query);
$execute->execute();
