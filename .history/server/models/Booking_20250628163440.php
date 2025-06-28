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
        // Call parent constructor to set up attributes array
        parent::__construct($data);

        // Map to individual properties for type safety
        $this->id = $data["id"];
        $this->userId = $data["user_id"];
        $this->showtimeId = $data["showtime_id"];
        $this->bookingTime = $data["booking_time"];
        $this->totalAmount = $data["total_amount"];
    }

    // Sync properties back to attributes array for database operations
    protected function syncToAttributes(): void
    {
        $this->attributes['id'] = $this->id;
        $this->attributes['user_id'] = $this->userId;
        $this->attributes['showtime_id'] = $this->showtimeId;
        $this->attributes['booking_time'] = $this->bookingTime;
        $this->attributes['total_amount'] = $this->totalAmount;
    }

    // Property-based getters (type-safe)
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

    // Property-based setters (type-safe)
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
