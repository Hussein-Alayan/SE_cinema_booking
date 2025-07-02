<?php
require_once("connection/config.php");

require_once("exceptions/ValidationException.php");

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
error_reporting(E_ALL); // report all error
ini_set('display_errors', 0);

// timezone
date_default_timezone_set('UTC');

//CORS
if (isset($_SERVER['HTTP_ORIGIN'])) {
    header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Allow-Headers: Content-Type, Authorization');
    header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');
}
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}
