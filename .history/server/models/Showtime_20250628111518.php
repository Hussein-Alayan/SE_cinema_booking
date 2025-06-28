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

    // Getters and setters 
}
