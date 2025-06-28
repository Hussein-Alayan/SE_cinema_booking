<?php
require_once("Model.php");

class BookingSeat extends Model
{
    private int $bookingId;
    private int $seatId;
    private float $pricePaid;

    protected static string $table = "booking_seats";

    public function __construct(array $data)
    {
        $this->bookingId = $data["booking_id"];
        $this->seatId = $data["seat_id"];
        $this->pricePaid = $data["price_paid"];
    }

    public static function findByBookingAndSeat(int $bookingId, int $seatId)
    {
        if (!self::$connection) {
            throw new Exception("Connection not set");
        }

        $sql = "SELECT * FROM booking_seats WHERE booking_id = ? AND seat_id = ?";

        $query = self::$connection->prepare($sql);
        $query->bind_param("ii", $bookingId, $seatId);
        $query->execute();

        $data = $query->get_result()->fetch_assoc();
        return $data ? new static($data) : null;
    }

    public function updateByCompositeKey()
    {
        if (!self::$connection) {
            throw new Exception("Connection not set");
        }

        $sql = "UPDATE booking_seats SET price_paid = ? WHERE booking_id = ? AND seat_id = ?";

        $query = self::$connection->prepare($sql);
        $query->bind_param("dii", $this->pricePaid, $this->bookingId, $this->seatId);

        if ($query->execute()) {
            return $query->affected_rows > 0;
        } else {
            throw new Exception("Failed to update booking seat: " . $query->error);
        }
    }

    public function deleteByCompositeKey()
    {
        if (!self::$connection) {
            throw new Exception("Connection not set");
        }

        $sql = "DELETE FROM booking_seats WHERE booking_id = ? AND seat_id = ?";

        $query = self::$connection->prepare($sql);
        $query->bind_param("ii", $this->bookingId, $this->seatId);

        if ($query->execute()) {
            return $query->affected_rows > 0;
        } else {
            throw new Exception("Failed to delete booking seat: " . $query->error);
        }
    }

    public static function createBookingSeat(array $data)
    {
        if (!self::$connection) {
            throw new Exception("Connection not set");
        }

        $sql = "INSERT INTO booking_seats (booking_id, seat_id, price_paid) VALUES (?, ?, ?)";

        $query = self::$connection->prepare($sql);
        $query->bind_param("iid", $data['booking_id'], $data['seat_id'], $data['price_paid']);

        if ($query->execute()) {
            return self::findByBookingAndSeat($data['booking_id'], $data['seat_id']);
        } else {
            throw new Exception("Failed to create booking seat: " . $query->error);
        }
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

    public function setPricePaid(float $value)
    {
        $this->pricePaid = $value;
    }
}
