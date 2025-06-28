<?php
require_once("Model.php");

class Seat extends Model
{
    private int $id;
    private int $auditoriumId;
    private string $rowLabel;
    private int $seatNumber;

    protected static string $table = "seats";

    public function __construct(array $data)
    {
        $this->id = $data["id"];
        $this->auditoriumId = $data["auditorium_id"];
        $this->rowLabel = $data["row_label"];
        $this->seatNumber = $data["seat_number"];
    }
    // Getters and setters 
}
