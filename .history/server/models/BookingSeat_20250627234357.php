<?php
require_once("Model.php");

class BookingSeat extends Model
{
    private int $booking_id;
    private int $seat_id;
    private float $price_paid;

    protected static string $table = "booking_seats";
    protected static string $primary_key = "booking_id"; // composite key, but for base class compatibility

    public function __construct(array $data)
    {
        $this->booking_id = $data["booking_id"];
        $this->seat_id = $data["seat_id"];
        $this->price_paid = $data["price_paid"];
    }
    // Getters and setters can be added here as needed
}
