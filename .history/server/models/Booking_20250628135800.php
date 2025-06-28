<?php
require_once("Model.php");

class Booking extends Model
{
    private int $id;
    private int $userId;
    private int $showtimeId;
    private string $bookingTime;
    private float $totalAmount;

    protected static string $table = "bookings";

    public function __construct(array $data)
    {
        $this->id = $data["id"];
        $this->userId = $data["user_id"];
        $this->showtimeId = $data["showtime_id"];
        $this->bookingTime = $data["booking_time"];
        $this->totalAmount = $data["total_amount"];
    }

    // Getters and setter
}
