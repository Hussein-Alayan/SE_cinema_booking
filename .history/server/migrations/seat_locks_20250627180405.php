<?php
require("../connection/config.php");

$query = "CREATE TABLE IF NOT EXISTS seat_locks (
    showtime_id INT NOT NULL,
    seat_id INT NOT NULL,
    locked_by_booking INT,
    locked_by_user INT NOT NULL,
    expires_at DATETIME NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (showtime_id, seat_id),
    FOREIGN KEY (showtime_id) REFERENCES showtimes(id) ON DELETE CASCADE,
    FOREIGN KEY (seat_id) REFERENCES seats(id) ON DELETE CASCADE,
    FOREIGN KEY (locked_by_booking) REFERENCES bookings(id) ON DELETE CASCADE,
    FOREIGN KEY (locked_by_user) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB;";

$execute = $mysqli->prepare($query);
$execute->execute();
