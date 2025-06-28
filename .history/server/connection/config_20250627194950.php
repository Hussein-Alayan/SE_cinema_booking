<?php 

$host = 'localhost';
$db_user = 'root';
$db_pass = '';
$dbname = 'SE_cinema_booking';

$mysqli = new mysqli($host, $db_user, $db_pass, $dbname);

if ($mysqli->connect_error){
    die('Connection failed: ' .$conn->connect_error);
} 