<?php
// server/test_connection.php

require_once __DIR__ . '/d';

if ($conn->connect_error) {
    echo '❌ Connection failed: ' . $conn->connect_error;
} else {
    echo '✅ Connected successfully to the database.';
}
