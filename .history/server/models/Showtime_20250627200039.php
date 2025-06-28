<?php
class Showtime
{
    private $mysqli;
    public function __construct($mysqli)
    {
        $this->mysqli = $mysqli;
    }

    public function addShowtime($movie_id, $auditorium_id, $show_date, $base_price)
    {
        $stmt = $this->mysqli->prepare("INSERT INTO showtimes (movie_id, auditorium_id, show_date, base_price) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iisd", $movie_id, $auditorium_id, $show_date, $base_price);
        return $stmt->execute();
    }

    public function getAllShowtimes()
    {
        $result = $this->mysqli->query("SELECT * FROM showtimes");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getShowtimesByMovie($movie_id)
    {
        $stmt = $this->mysqli->prepare("SELECT * FROM showtimes WHERE movie_id = ?");
        $stmt->bind_param("i", $movie_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}
