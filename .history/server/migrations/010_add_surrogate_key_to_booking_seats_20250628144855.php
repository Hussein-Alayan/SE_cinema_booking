<?php
require("../connection/config.php");

// Step 1: Drop the existing composite primary key
$query1 = "ALTER TABLE booking_seats DROP PRIMARY KEY";
$execute1 = $mysqli->prepare($query1);
$execute1->execute();

// Step 2: Add the new surrogate primary key column
$query2 = "ALTER TABLE booking_seats ADD COLUMN id INT AUTO_INCREMENT PRIMARY KEY FIRST";
$execute2 = $mysqli->prepare($query2);
$execute2->execute();

// Step 3: Add unique constraint to maintain business rule (prevent double-booking)
$query3 = "ALTER TABLE booking_seats ADD UNIQUE KEY unique_booking_seat (booking_id, seat_id)";
$execute3 = $mysqli->prepare($query3);
$execute3->execute();

echo "Successfully added surrogate key to booking_seats table.";
