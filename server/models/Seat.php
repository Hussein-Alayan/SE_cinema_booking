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
        parent::__construct($data);

        $this->id = $data["id"];
        $this->auditoriumId = $data["auditorium_id"];
        $this->rowLabel = $data["row_label"];
        $this->seatNumber = $data["seat_number"];
    }

    protected function syncToAttributes(): void
    {
        $this->attributes['id'] = $this->id;
        $this->attributes['auditorium_id'] = $this->auditoriumId;
        $this->attributes['row_label'] = $this->rowLabel;
        $this->attributes['seat_number'] = $this->seatNumber;
    }

    public function getId()
    {
        return $this->id;
    }
    public function getAuditoriumId()
    {
        return $this->auditoriumId;
    }
    public function getRowLabel()
    {
        return $this->rowLabel;
    }
    public function getSeatNumber()
    {
        return $this->seatNumber;
    }

    public function setAuditoriumId(int $value)
    {
        $this->auditoriumId = $value;
    }
    public function setRowLabel(string $value)
    {
        $this->rowLabel = $value;
    }
    public function setSeatNumber(int $value)
    {
        $this->seatNumber = $value;
    }
}
