<?php
require_once("Model.php");

class Auditorium extends Model
{
    private int $id;
    private string $name;
    private int $totalSeats;

    protected static string $table = "auditoriums";

    public function __construct(array $data)
    {
        $this->id = $data["id"];
        $this->name = $data["name"];
        $this->totalSeats = $data["total_seats"];
    }
    // Getters and setters can be added here as needed
}
