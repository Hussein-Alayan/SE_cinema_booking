<?php
require_once("connection/config.php");
require_once("models/Model.php");
require_once("models/Movie.php");
require_once("models/Showtime.php");
require_once("models/SeatLock.php");
require_once("models/BookingSeat.php");

// Set up database connection for all models
Model::setConnection($mysqli);

echo "=== Cinema Booking System Model Tests ===\n\n";

// Test 1: Create a new movie
echo "1. Creating a new movie...\n";
try {
    $movieData = [
        'title' => 'The Matrix',
        'rating' => 'R',
        'duration_minutes' => 136,
        'release_date' => '1999-03-31',
        'trailer_url' => 'https://example.com/matrix-trailer'
    ];
    
    $movie = Movie::create($movieData);
    echo "✅ Movie created successfully! ID: " . $movie->get('id') . "\n";
    echo "   Title: " . $movie->get('title') . "\n";
    echo "   Rating: " . $movie->get('rating') . "\n\n";
} catch (Exception $e) {
    echo "❌ Error creating movie: " . $e->getMessage() . "\n\n";
}

// Test 2: Find a movie by ID
echo "2. Finding movie by ID...\n";
try {
    $foundMovie = Movie::find(1);
    if ($foundMovie) {
        echo "✅ Movie found! Title: " . $foundMovie->get('title') . "\n\n";
    } else {
        echo "❌ Movie not found\n\n";
    }
} catch (Exception $e) {
    echo "❌ Error finding movie: " . $e->getMessage() . "\n\n";
}

// Test 3: Update a movie
echo "3. Updating movie...\n";
try {
    $movie = Movie::find(1);
    if ($movie) {
        $movie->set('title', 'The Matrix Reloaded');
        $movie->set('rating', 'PG-13');
        $result = $movie->update();
        if ($result) {
            echo "✅ Movie updated successfully!\n\n";
        } else {
            echo "❌ Failed to update movie\n\n";
        }
    }
} catch (Exception $e) {
    echo "❌ Error updating movie: " . $e->getMessage() . "\n\n";
}

// Test 4: Create a seat lock (composite key)
echo "4. Creating a seat lock...\n";
try {
    $lockData = [
        'showtime_id' => 1,
        'seat_id' => 101,
        'locked_by_booking' => null,
        'locked_by_user' => 1,
        'expires_at' => date('Y-m-d H:i:s', strtotime('+15 minutes'))
    ];
    
    $seatLock = SeatLock::createSeatLock($lockData);
    echo "✅ Seat lock created successfully!\n";
    echo "   Showtime ID: " . $seatLock->get('showtime_id') . "\n";
    echo "   Seat ID: " . $seatLock->get('seat_id') . "\n";
    echo "   Expires: " . $seatLock->get('expires_at') . "\n\n";
} catch (Exception $e) {
    echo "❌ Error creating seat lock: " . $e->getMessage() . "\n\n";
}

// Test 5: Find seat lock by composite key
echo "5. Finding seat lock by composite key...\n";
try {
    $foundLock = SeatLock::findByShowtimeAndSeat(1, 101);
    if ($foundLock) {
        echo "✅ Seat lock found!\n";
        echo "   Locked by user: " . $foundLock->get('locked_by_user') . "\n\n";
    } else {
        echo "❌ Seat lock not found\n\n";
    }
} catch (Exception $e) {
    echo "❌ Error finding seat lock: " . $e->getMessage() . "\n\n";
}

// Test 6: Update seat lock
echo "6. Updating seat lock...\n";
try {
    $lock = SeatLock::findByShowtimeAndSeat(1, 101);
    if ($lock) {
        $lock->set('expires_at', date('Y-m-d H:i:s', strtotime('+30 minutes')));
        $result = $lock->updateByCompositeKey();
        if ($result) {
            echo "✅ Seat lock updated successfully!\n\n";
        } else {
            echo "❌ Failed to update seat lock\n\n";
        }
    }
} catch (Exception $e) {
    echo "❌ Error updating seat lock: " . $e->getMessage() . "\n\n";
}

// Test 7: Get all movies
echo "7. Getting all movies...\n";
try {
    $movies = Movie::all();
    echo "✅ Found " . count($movies) . " movies:\n";
    foreach ($movies as $movie) {
        echo "   - " . $movie->get('title') . " (ID: " . $movie->get('id') . ")\n";
    }
    echo "\n";
} catch (Exception $e) {
    echo "❌ Error getting movies: " . $e->getMessage() . "\n\n";
}

echo "=== Test Complete ===\n";
