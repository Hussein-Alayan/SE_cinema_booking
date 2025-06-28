<?php
class Booking
{
    private $mysqli;
    public function __construct($mysqli)
    {
        $this->mysqli = $mysqli;
    }

    public function createBooking($user_id, $showtime_id, $total_amount)
    {
        $stmt = $this->mysqli->prepare("INSERT INTO bookings (user_id, showtime_id, total_amount) VALUES (?, ?, ?)");
        $stmt->bind_param("iid", $user_id, $showtime_id, $total_amount);
        $stmt->execute();
        return $this->mysqli->insert_id;
    }

    public function getBookingsByUser($user_id)
    {
        $stmt = $this->mysqli->prepare("SELECT * FROM bookings WHERE user_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getBookingById($id)
    {
        $stmt = $this->mysqli->prepare("SELECT * FROM bookings WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
}
