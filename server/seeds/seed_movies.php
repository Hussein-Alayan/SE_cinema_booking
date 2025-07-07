<?php
require_once(__DIR__ . "/../connection/config.php");


$query = "INSERT INTO movies (title, rating, duration_minutes, release_date, trailer_url, poster_url, created_at) VALUES 
('Snow White', 'G', 95, '2024-03-22', 'https://youtube.com', 'assets/images/au_movies_snowwhite_disneyplus_poster_436aff17.jpeg', NOW()),
('Moana 2', 'PG', 105, '2024-11-27', 'https://youtube.com', 'assets/images/moana2reomaori_poster_540x810_538fc872.jpeg', NOW()),
('Fantastic Four: First Steps', 'PG-13', 125, '2025-02-14', 'https://youtube.com', 'assets/images/au_movies_marvel_fantasticfourfirststeps_official_poste_daf083fc.jpeg', NOW()),
('Freaky Friday 2', 'PG', 98, '2024-08-09', 'https://youtube.com', 'assets/images/au_movies_disney_freakier-friday_poster_e73a6f43.jpeg', NOW()),
('Zootopia 2', 'G', 108, '2025-11-26', 'https://youtube.com', 'assets/images/au_poster_movies_disney_zootopia2_teaser_b4cb9449.jpeg', NOW()),
('The Matrix', 'R', 136, '1999-03-31', 'https://youtube.com', 'assets/images/teaser_1sht_-_rgb_for_online_use_only_6b92ba3f.jpeg', NOW()),
('Inception', 'PG-13', 148, '2010-07-16', 'https://youtube.com', 'assets/images/image_80a77b1d.jpeg', NOW())";

$execute = $mysqli->prepare($query);
$execute->execute();

echo "Movies seeded successfully!";
