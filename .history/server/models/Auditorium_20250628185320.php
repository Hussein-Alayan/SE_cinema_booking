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
        parent::__construct($data);
    
        $this->id = $data["id"];
        $this->name = $data["name"];
        $this->totalSeats = $data["total_seats"];
    }
    //used to sync data from database to object 
    
    protected function syncToAttributes(): void
    {
        $this->attributes['id'] = $this->id;
        $this->attributes['name'] = $this->name;
        $this->attributes['total_seats'] = $this->totalSeats;
    }

    public function getId()
    {
        return $this->id;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getTotalSeats()
    {
        return $this->totalSeats;
    }

    public function setName(string $value)
    {
        $this->name = $value;
    }
    public function setTotalSeats(int $value)
    {
        $this->totalSeats = $value;
    }
}
