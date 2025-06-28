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

    // Custom find method for composite key
    public static function findByShowtimeAndSeat(int $showtimeId, int $seatId)
    {
        $sql = "SELECT * FROM seat_locks WHERE showtime_id = ? AND seat_id = ?";

        $query = self::$connection->prepare($sql);
        $query->bind_param("ii", $showtimeId, $seatId);
        $query->execute();

        $data = $query->get_result()->fetch_assoc();
        return $data ? new static($data) : null;
    }

    public function __construct(array $data)
    {
        $this->showtimeId = $data["showtime_id"];
        $this->seatId = $data["seat_id"];
        $this->lockedByBooking = $data["locked_by_booking"];
        $this->lockedByUser = $data["locked_by_user"];
        $this->expiresAt = $data["expires_at"];
        $this->createdAt = $data["created_at"];
    }

    // Add custom methods for composite key operations
    public static function findByCompositeKey(int $showtimeId, int $seatId)
    {
        // Implementation for composite key lookup
    }

    public function updateByCompositeKey()
    {
        // Implementation for composite key update
    }

    public function deleteByCompositeKey()
    {
        // Implementation for composite key delete
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

    // Getters and setters can be added here as needed
}
