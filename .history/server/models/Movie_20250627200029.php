<?php
class Movie {
    private $mysqli;
    public function __construct($mysqli) {
        $this->mysqli = $mysqli;
    }

    public function addMovie($title, $rating, $duration, $release_date, $trailer_url) {
        $stmt = $this->mysqli->prepare("INSERT INTO movies (title, rating, duration_minutes, release_date, trailer_url) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssiss", $title, $rating, $duration, $release_date, $trailer_url);
        return $stmt->execute();
    }

    public function getAllMovies() {
        $result = $this->mysqli->query("SELECT * FROM movies");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getMovieById($id) {
        $stmt = $this->mysqli->prepare("SELECT * FROM movies WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
} 