<?php 

$host = 'localhost';
$db_user = 'root';
$db_pass = null;
$database = 'SE_cinema_booking';

$conn = new mysqli($host, $dbuser, $password, $dbname);

if ($conn->connect_error){
    die('Connection failed: ' .$conn->connect_error);
}