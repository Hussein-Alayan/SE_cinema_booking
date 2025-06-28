<?php
require_once("Model.php");

class Booking extends Model
{
    private int $id;
    private int $user_id;
    private int $showtime_id;
    private string $booking_time;
    private float $total_amount;

    protected static string $table = "bookings";

    public function __construct(array $data)
    {
        $this->id = $data["id"];
        $this->user_id = $data["user_id"];
        $this->showtime_id = $data["showtime_id"];
        $this->booking_time = $data["booking_time"];
        $this->total_amount = $data["total_amount"];
    }

    // Getters and setters can be added here as needed
}
