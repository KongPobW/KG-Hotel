<?php
class BookingHistory {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

   public function getBookings($user_id) {
        $query = "
            SELECT 
                bo.booking_id, 
                date(bo.booking_date) AS booking_date, 
                date(bo.check_in_date) AS check_in_date, 
                date(bo.check_out_date) AS check_out_date,
                bo.total_amount, 
                bo.status,
                bd.name AS booker_name, 
                r.name AS room_name, 
                rc.cover
            FROM booking_order bo
            JOIN booking_details bd ON bo.booking_id = bd.booking_id
            JOIN room r ON bd.room_id = r.id
            LEFT JOIN room_covers rc ON r.id = rc.id_room
            WHERE bo.user_id = ?
            GROUP BY bd.book_detail_id
            ORDER BY bo.booking_date DESC
        ";

        $stmt = $this->conn->prepare($query);
        $stmt->execute([$user_id]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

$database = new Database();
$db = $database->getConnection();

$booking_history = new BookingHistory($db);
$bookings = $booking_history->getBookings($user_id);
?>