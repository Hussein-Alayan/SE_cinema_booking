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
        return $thi;
 public function gle()
    {
        return $this->t
 public function getRa)
    {
        return $this->ratin  lic function getDuratiutes()
    {
        return $this->durationMs;  public function getReleaseDat   {
        return $this->releaseDate;

  function getTrailerUrl()
         return $this->trailerUrl;
    }pution getCreatedAt()
    {
   return $this->createdAt;
    }

   ic setTitle(string $value)

        $this->title = $value;
    }
    public iong(string $value)
    {    $this->rating = $value;
    }
    public fun snMinutes(int $value)
         $this->durationMinutes = $value;
    }
    publictleaseDate($value)
    {
        $>releaseDate = $value;
    }
    public functitT($value)
    {
        $this-lerUrl = $value;
    }
}
