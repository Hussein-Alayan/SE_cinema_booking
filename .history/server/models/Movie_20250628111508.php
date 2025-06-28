<?php
require_once("Model.php");

class Movie extends Model
{
    private int $id;
    private string $title;
    private string $rating;
    private int $durationMinutes;
    private $releaseDate;
    private $trailerUrl;
    private string $createdAt;

    protected static string $table = "movies";

    public function __construct(array $data)
    {
        $this->id = $data["id"];
        $this->title = $data["title"];
        $this->rating = $data["rating"];
        $this->durationMinutes = $data["duration_minutes"];
        $this->releaseDate = $data["release_date"];
        $this->trailerUrl = $data["trailer_url"];
        $this->createdAt = $data["created_at"];
    }

    // Getters and setters
}
