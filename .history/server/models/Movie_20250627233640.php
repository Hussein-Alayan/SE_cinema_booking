<?php
require_once("Model.php");

class Movie extends Model {
    private int $id;
    private string $title;
    private string $rating;
    private int $duration_minutes;
    private $release_date; // can be null
    private $trailer_url; // can be null
    private string $created_at;

    protected static string $table = "movies";

    public function __construct(array $data) {
        $this->id = $data["id"];
        $this->title = $data["title"];
        $this->rating = $data["rating"];
        $this->duration_minutes = $data["duration_minutes"];
        $this->release_date = $data["release_date"];
        $this->trailer_url = $data["trailer_url"];
        $this->created_at = $data["created_at"];
    }

    // Getters and setters can be added here as needed
} 