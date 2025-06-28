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
        $this->id = $data["id"];
        $this->bookingId = $data["booking_id"];
        $this->seatId = $data["seat_id"];
        $this->pricePaid = $data["price_paid"];
    }

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
