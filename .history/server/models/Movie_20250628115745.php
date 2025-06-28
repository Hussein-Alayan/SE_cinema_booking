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

    public function getId()
    {
        return $this->id;
    }
    public function getTitle()
    {
        return $this->title;
    }
    public function getRating()
    {
        return $this->rating;
    }
    public function getDurationMinutes()
    {
        return $this->durationMinutes;
    }
    public function getReleaseDate()
    {
        return $this->releaseDate;
    }
    public function getTrailerUrl()
    {
        return $this->trailerUrl;
    }
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setTitle(string $value)
    {
        $this->title = $value;
    }
    public function setRating(string $value)
    {
        $this->rating = $value;
    }
    public function setDurationMinutes(int $value)
    {
        $this->durationMinutes = $value;
    }
    public function setReleaseDate($value)
    {
        $this->releaseDate = $value;
    }
    public function setTrailerUrl($value)
    {
        $this->trailerUrl = $value;
    }
}
