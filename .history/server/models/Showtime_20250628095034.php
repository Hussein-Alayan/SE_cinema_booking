<?php
require_once("Model.php");

class Showtime extends Model
{
    private int $id;
    private int $movie_id;
    private int $auditorium_id;
    private string $show_date;
    private float $base_price;

    protected static string $table = "showtimes";

    public function __construct(array $data)
    {
        $this->id = $data["id"];
        $this->movie_id = $data["movie_id"];
        $this->auditorium_id = $data["auditorium_id"];
        $this->show_date = $data["show_date"];
        $this->base_price = $data["base_price"];
    }

    // Getters and setters 
}
