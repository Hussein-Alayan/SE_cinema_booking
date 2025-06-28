<?php
require_once("Model.php");

class SeatLock extends Model
{
    private int $showtimeId;
    private int $seatId;
    private $lockedByBooking;
    private int $lockedByUser;
    private string $expiresAt;
    private string $createdAt;

    protected static string $table = "seat_locks";

    public function __construct(array $data)
    {
        $this->showtimeId = $data["showtime_id"];
        $this->seatId = $data["seat_id"];
        $this->lockedByBooking = $data["locked_by_booking"];
        $this->lockedByUser = $data["locked_by_user"];
        $this->expiresAt = $data["expires_at"];
        $this->createdAt = $data["created_at"];
    }

    public static function findByShowtimeAndSeat(int $showtimeId, int $seatId)
    {
        if (!self::$connection) {
            throw new Exception("Connection not set");
        }

        $sql = "SELECT * FROM seat_locks WHERE showtime_id = ? AND seat_id = ?";

        $query = self::$connection->prepare($sql);
        $query->bind_param("ii", $showtimeId, $seatId);
        $query->execute();

        $data = $query->get_result()->fetch_assoc();
        return $data ? new static($data) : null;
    }

    public function updateByCompositeKey()
    {
        if (!self::$connection) {
            throw new Exception("Connection not set");
        }

        $sql = "UPDATE seat_locks SET 
                locked_by_booking = ?, 
                locked_by_user = ?, 
                expires_at = ?, 
                created_at = ? 
                WHERE showtime_id = ? AND seat_id = ?";

        $query = self::$connection->prepare($sql);
        $query->bind_param(
            "iissii",
            $this->lockedByBooking,
            $this->lockedByUser,
            $this->expiresAt,
            $this->createdAt,
            $this->showtimeId,
            $this->seatId
        );

        if ($query->execute()) {
            return $query->affected_rows > 0;
        } else {
            throw new Exception("Failed to update seat lock: " . $query->error);
        }
    }

    public function deleteByCompositeKey()
    {
        if (!self::$connection) {
            throw new Exception("Connection not set");
        }

        $sql = "DELETE FROM seat_locks WHERE showtime_id = ? AND seat_id = ?";

        $query = self::$connection->prepare($sql);
        $query->bind_param("ii", $this->showtimeId, $this->seatId);

        if ($query->execute()) {
            return $query->affected_rows > 0;
        } else {
            throw new Exception("Failed to delete seat lock: " . $query->error);
        }
    }

    public static function createSeatLock(array $data)
    {
        if (!self::$connection) {
            throw new Exception("Connection not set");
        }

        $sql = "INSERT INTO seat_locks (showtime_id, seat_id, locked_by_booking, locked_by_user, expires_at) 
                VALUES (?, ?, ?, ?, ?)";

        $query = self::$connection->prepare($sql);
        $query->bind_param(
            "iiiss",
            $data['showtime_id'],
            $data['seat_id'],
            $data['locked_by_booking'],
            $data['locked_by_user'],
            $data['expires_at']
        );

        if ($query->execute()) {
            return self::findByShowtimeAndSeat($data['showtime_id'], $data['seat_id']);
        } else {
            throw new Exception("Failed to create seat lock: " . $query->error);
        }
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
