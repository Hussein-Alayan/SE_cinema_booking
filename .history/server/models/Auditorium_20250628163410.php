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
        // Call parent constructor to set up attributes array
        parent::__construct($data);
        
        // Map to individual properties for type safety
        $this->id = $data["id"];
        $this->name = $data["name"];
        $this->totalSeats = $data["total_seats"];
    }

    // Sync properties back to attributes array for database operations
    protected function syncToAttributes(): void
    {
        $this->attributes['id'] = $this->id;
        $this->attributes['name'] = $this->name;
        $this->attributes['total_seats'] = $this->totalSeats;
    }

    // Property-based getters (type-safe)
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

    // Property-based setters (type-safe)
    public function setName(string $value)
    {
        $this->name = $value;
    }
    public function setTotalSeats(int $value)
    {
        $this->totalSeats = $value;
    }
}
