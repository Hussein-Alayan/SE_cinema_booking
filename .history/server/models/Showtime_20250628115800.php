<?php
require_once("Model.php");

class Showtime extends Model
{
    private int $id;
    private int $movieId;
    private int $auditoriumId;
    private string $showDate;
    private float $basePrice;

    protected static string $table = "showtimes";

    public function __construct(array $data)
    {
        $this->id = $data["id"];
        $this->movieId = $data["movie_id"];
        $this->auditoriumId = $data["auditorium_id"];
        $this->showDate = $data["show_date"];
        $this->basePrice = $data["base_price"];
    }

    public function getId()
    {
        return $this->id;
    }
    public function getMovieId()
    {
        return $this->movieId;
    }
    public function getAuditoriumId()
    {
        return $this->auditoriumId;
    }
    public function getShowDate()
    {
        return $this->showDate;
    }
    public function getBasePrice()
    {
        return $this->basePrice;
    }

    public function setMovieId(int $value)
    {
        $this->movieId = $value;
    }
    public function setAuditoriumId(int $value)
    {
        $this->auditoriumId = $value;
    }
    public function setShowDate(string $value)
    {
        $this->showDate = $value;
    }
    public function setBasePrice(float $value)
    {
        $this->basePrice = $value;
    }
}
