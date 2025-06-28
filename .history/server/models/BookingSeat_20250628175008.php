<?php
require_once("Model.php");

class BookingSeat extends Model
{
    private int $id;
    private int $bookingId;
    private int $seatId;
    private float $pricePaid;

    protected static string $table = "booking_seats";

    public function __construct(array $data)
    {
        parent::__construct($data);
        $this->id = $data["id"];
        $this->bookingId = $data["booking_id"];
        $this->seatId = $data["seat_id"];
        $this->pricePaid = $data["price_paid"];
    }

    // Sync properties back to attributes array for database operations
    protected function syncToAttributes(): void
    {
        $this->attributes['id'] = $this->id;
        $this->attributes['booking_id'] = $this->bookingId;
        $this->attributes['seat_id'] = $this->seatId;
        $this->attributes['price_paid'] = $this->pricePaid;
    }

    // Property-based getters (type-safe)
    public function getId()
    {
        return $this->id;
    }
    public function getBookingId()
    {
        return $this->bookingId;
    }
    public function getSeatId()
    {
        return $this->seatId;
    }
    public function getPricePaid()
    {
        return $this->pricePaid;
    }

    // Property-based setters (type-safe)
    public function setBookingId(int $value)
    {
        $this->bookingId = $value;
    }
    public function setSeatId(int $value)
    {
        $this->seatId = $value;
    }
    public function setPricePaid(float $value)
    {
        $this->pricePaid = $value;
    }
}
