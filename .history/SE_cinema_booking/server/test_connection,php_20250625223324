<?php
// server/test_connection.php

// 1. Include your config so $conn is available
require_once __DIR__ . '/config.php';

try {
    // 2. Do a simple query – this one just asks MySQL for the current date/time
    $result = $conn->query('SELECT NOW() AS now');
    
    if ($row = $result->fetch_assoc()) {
        // 3. If we got a row back, the connection and query both worked
        echo '✅ Connected successfully. Server time is: ' . $row['now'];
    } else {
        // unlikely, but handles the case where the query returns no rows
        echo '⚠️ Connected, but no data returned.';
    }
} catch (Exception $e) {
    // 4. If anything went wrong (connection or query), catch it here
    echo '❌ Connection or query failed: ' . $e->getMessage();
}
