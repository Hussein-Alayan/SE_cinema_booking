<?php
require_once("Model.php");

class SeatLock extends Model
{
    private int $id;
    private int $showtimeId;
    private int $seatId;
    private $lockedByBooking;
    private int $lockedByUser;
    private string $expiresAt;
    private string $createdAt;

    protected static string $table = "seat_locks";

    public function __construct(array $data)
    {
        $this->id = $data["id"];
        $this->showtimeId = $data["showtime_id"];
        $this->seatId = $data["seat_id"];
        $this->lockedByBooking = $data["locked_by_booking"];
        $this->lockedByUser = $data["locked_by_user"];
        $this->expiresAt = $data["expires_at"];
        $this->createdAt = $data["created_at"];
    }

    public function getId()
    {
        return $this->id;
    }
    public function getShowtimeId()
    {
        return $this->showtimeId;
    }
    public function getSeatId()
    {
        return $this->seatId;
    }
    public function getLockedByBooking()
    {
        return $this->lockedByBooking;
    }
    public function getLockedByUser()
    {
        return $this->lockedByUser;
    }
    public function getExpiresAt()
    {
        return $this->expiresAt;
    }
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setShowtimeId(int $value)
    {
        $this->showtimeId = $value;
    }
    public function setSeatId(int $value)
    {
        $this->seatId = $value;
    }
    public function setLockedByBooking($value)
    {
        $this->lockedByBooking = $value;
    }
    public function setLockedByUser(int $value)
    {
        $this->lockedByUser = $value;
    }
    public function setExpiresAt(string $value)
    {
        $this->expiresAt = $value;
    }
}
