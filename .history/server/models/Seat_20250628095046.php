<?php
require_once("Model.php");

class Seat extends Model
{
    private int $id;
    private int $auditorium_id;
    private string $row_label;
    private int $seat_number;

    protected static string $table = "seats";

    public function __construct(array $data)
    {
        $this->id = $data["id"];
        $this->auditorium_id = $data["auditorium_id"];
        $this->row_label = $data["row_label"];
        $this->seat_number = $data["seat_number"];
    }
    // Getters and setters 
}
