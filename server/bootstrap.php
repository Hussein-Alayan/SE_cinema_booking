<?php
// Load configuration
require_once("connection/config.php");

// Load exceptions
require_once("exceptions/ValidationException.php");

// Load base model
require_once("models/Model.php");

// Load all models
require_once("models/User.php");
require_once("models/Movie.php");
require_once("models/Showtime.php");
require_once("models/Booking.php");
require_once("models/Seat.php");
require_once("models/Auditorium.php");
require_once("models/PaymentMethod.php");
require_once("models/BookingSeat.php");
require_once("models/SeatLock.php");

// Set connection once for all models
global $mysqli;
Model::setConnection($mysqli);

// Set error handling
error_reporting(E_ALL);
ini_set('display_errors', 0);

// Set timezone
date_default_timezone_set('UTC');
