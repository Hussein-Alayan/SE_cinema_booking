<?php
require_once("Model.php");

class BookingSeat extends Model
{
    private int $bookingId;
    private int $seatId;
    private float $pricePaid;

    protected static string $table = "booking_seats";
    protected static string $primary_key = "booking_id"; // composite key, but for base class compatibility

    public function __construct(array $data)
    {
        $this->bookingId = $data["booking_id"];
        $this->seatId = $data["seat_id"];
        $this->pricePaid = $data["price_paid"];
    }
    // Getters and setters
}
