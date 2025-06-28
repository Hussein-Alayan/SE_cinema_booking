<?php
require("../connection/config.php");

$query = "CREATE TABLE IF NOT EXISTS seat_locks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    showtime_id INT NOT NULL,
    seat_id INT NOT NULL,
    locked_by_booking INT,
    locked_by_user INT NOT NULL,
    expires_at DATETIME NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY unique_showtime_seat (showtime_id, seat_id),
    FOREIGN KEY (showtime_id) REFERENCES showtimes(id) ON DELETE CASCADE,
    FOREIGN KEY (seat_id) REFERENCES seats(id) ON DELETE CASCADE,
    FOREIGN KEY (locked_by_booking) REFERENCES bookings(id) ON DELETE CASCADE,
    FOREIGN KEY (locked_by_user) REFERENCES users(id) ON DELETE CASCADE
)";

$execute = $mysqli->prepare($query);
$execute->execute();
