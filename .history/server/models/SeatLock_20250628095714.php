<?php
require_once("Model.php");

class SeatLock extends Model
{
    private int $showtime_id;
    private int $seat_id;
    private $locked_by_booking; 
    private int $locked_by_user;
    private string $expires_at;
    private string $created_at;

    protected static string $table = "seat_locks";
    protected static string $primary_key = "showtime_id"; // composite key, but for base class compatibility

    public function __construct(array $data)
    {
        $this->showtime_id = $data["showtime_id"];
        $this->seat_id = $data["seat_id"];
        $this->locked_by_booking = $data["locked_by_booking"];
        $this->locked_by_user = $data["locked_by_user"];
        $this->expires_at = $data["expires_at"];
        $this->created_at = $data["created_at"];
    }
    // Getters and setters can be added here as needed
}
