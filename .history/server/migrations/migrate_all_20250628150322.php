<?php
require("001_create_users_table.php");
require("002_create_movies_table.php");
require("003_create_auditoriums_table.php");
require("004_create_seats_table.php");
require("005_create_showtimes_table.php");
require("006_create_bookings_table.php");
require("007_create_booking_seats_table.php");
require("008_create_seat_locks_table.php");
require("009_create_payment_methods_table.php");
require("010_add_surrogate_key_to_booking_seats.php");
echo "All migrations executed.";
