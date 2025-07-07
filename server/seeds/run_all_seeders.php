<?php

// Seed users
echo "Seeding users...\n";
require_once("seed_users.php");
echo "\n";

// Seed movies
echo "Seeding movies...\n";
require_once("seed_movies.php");
echo "\n";

echo "All seeders completed successfully!\n";
