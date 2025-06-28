<?php
class Booking
{
    private $mysqli;
    public function __construct($mysqli)
    {
        $this->mysqli = $mysqli;
    }

    public function createBooking($userId, $showtimeId, $totalAmount)
    {
        $stmt = $this->mysqli->prepare("INSERT INTO bookings (user_id, showtime_id, total_amount) VALUES (?, ?, ?)");
        $stmt->bind_param("iid", $userId, $showtimeId, $totalAmount);
        $stmt->execute();
        return $this->mysqli->insert_id;
    }

    public function getBookingsByUser($userId)
    {
        $stmt = $this->mysqli->prepare("SELECT * FROM bookings WHERE user_id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getBookingDetails($bookingId)
    {
        $stmt = $this->mysqli->prepare("SELECT * FROM bookings WHERE id = ?");
        $stmt->bind_param("i", $bookingId);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
}
