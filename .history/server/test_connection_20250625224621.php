<?php
// server/test_connection.php

<?php
require_once __DIR__ . '/connection/config.php';

if ($conn->connect_error) {
    echo '❌ Connection failed: ' . $conn->connect_error;
} else {
    echo '✅ Connected successfully to the database.';
}

if ($conn->connect_error) {
    echo '❌ Connection failed: ' . $conn->connect_error;
} else {
    echo '✅ Connected successfully to the database.';
}
