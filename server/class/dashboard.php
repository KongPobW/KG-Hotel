<?php
class Dashboard {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getTotalBookings() {
        $query = "SELECT COUNT(*) FROM booking_order";
        return $this->conn->query($query)->fetchColumn();
    }

    public function getTotalBookedRooms() {
        $query = "SELECT COUNT(*) FROM booking_details bd JOIN booking_order bo ON bd.booking_id = bo.booking_id WHERE status <> 'cancelled'";
        return $this->conn->query($query)->fetchColumn();
    }

    public function getTotalRevenue() {
        $query = "SELECT SUM(total_amount) FROM booking_order WHERE status = 'completed'";
        $result = $this->conn->query($query)->fetchColumn();
        return $result ? $result : 0;
    }

    public function getBookingStatusCounts() {
        $query = "SELECT status, COUNT(*) as count FROM booking_order GROUP BY status";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $counts = [
            'pending' => 0,
            'completed' => 0,
            'cancelled' => 0,
            'refunding' => 0
        ];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $counts[$row['status']] = (int)$row['count'];
        }

        return $counts;
    }

    public function getTopBookedRooms($limit = 5) {
        $query = "
            SELECT r.name, COUNT(*) as bookings
            FROM booking_details bd
            JOIN room r ON bd.room_id = r.id
            GROUP BY bd.room_id
            ORDER BY bookings DESC
            LIMIT :limit
        ";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();

        $rooms = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $rooms[] = $row;
        }

        return $rooms;
    }
}

$database = new Database();
$db = $database->getConnection();

$dashboard = new Dashboard($db);

$totalBookings = $dashboard->getTotalBookings();
$totalBookedRooms = $dashboard->getTotalBookedRooms();
$totalRevenue = $dashboard->getTotalRevenue();
$statusCounts = $dashboard->getBookingStatusCounts();
$topRooms = $dashboard->getTopBookedRooms();

$topRoomNames = array_column($topRooms, 'name');
$topRoomCounts = array_column($topRooms, 'bookings');
?>