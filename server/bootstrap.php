<?php
require_once(__DIR__ . "/connection/config.php");

require_once(__DIR__ . "/exceptions/ValidationException.php");

require_once(__DIR__ . "/models/Model.php");

// Load all models
require_once(__DIR__ . "/models/User.php");
require_once(__DIR__ . "/models/Movie.php");
require_once(__DIR__ . "/models/Showtime.php");
require_once(__DIR__ . "/models/Booking.php");
require_once(__DIR__ . "/models/Seat.php");
require_once(__DIR__ . "/models/Auditorium.php");
require_once(__DIR__ . "/models/PaymentMethod.php");
require_once(__DIR__ . "/models/BookingSeat.php");
require_once(__DIR__ . "/models/SeatLock.php");

// Load services
require_once(__DIR__ . "/services/ResponseService.php");
require_once(__DIR__ . "/services/ValidationService.php");

// Set connection once for all models
global $mysqli;
Model::setConnection($mysqli);

// Set error handling
error_reporting(E_ALL); // report all error
ini_set('display_errors', 0);

// timezone
date_default_timezone_set('UTC');

//CORS - More permissive for development
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
header('Access-Control-Allow-Methods: GET, POST');

// Handle preflight OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}
