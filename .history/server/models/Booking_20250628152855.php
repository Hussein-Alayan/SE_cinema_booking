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

    public function getId()
    {
        return $this->id;
    }
    public function getUserId()
    {
        return $this->userId;
    }
    public function getShowtimeId()
    {
        return $this->showtimeId;
    }
    public function getBookingTime()
    {
        return $this->bookingTime;
    }
    public function getTotalAmount()
    {
        return $this->totalAmount;
    }

    public function setUserId(int $value)
    {
        $this->userId = $value;
    }
    public function setShowtimeId(int $value)
    {
        $this->showtimeId = $value;
    }
    public function setBookingTime(string $value)
    {
        $this->bookingTime = $value;
    }
    public function setTotalAmount(float $value)
    {
        $this->totalAmount = $value;
    }
}
