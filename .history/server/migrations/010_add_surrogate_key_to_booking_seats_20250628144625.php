ALTER TABLE booking_seats
ADD COLUMN id INT AUTO_INCREMENT PRIMARY KEY FIRST,
ADD UNIQUE KEY unique_booking_seat (booking_id, seat_id);