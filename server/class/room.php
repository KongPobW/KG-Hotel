<?php
class Room {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getFilteredRoomsWithLimit($limit) {
        $filters = [
            'children' => $_GET['children'] ?? null,
            'adults' => $_GET['adults'] ?? null,
            'checkin' => $_GET['checkin'] ?? null,
            'checkout' => $_GET['checkout'] ?? null,
        ];

        $conditions = ["r.status = 1"];
        $params = [];

        if (!empty($filters['adults'])) {
            $conditions[] = "r.adult >= :adults";
            $params[':adults'] = $filters['adults'];
        }

        if (!empty($filters['children'])) {
            $conditions[] = "r.children >= :children";
            $params[':children'] = $filters['children'];
        }

        if (!empty($filters['checkin']) && !empty($filters['checkout'])) {
            $conditions[] = "r.id NOT IN (
                SELECT bd.room_id
                FROM booking_details bd
                JOIN booking_order bo ON bd.booking_id = bo.booking_id
                WHERE bo.status IN ('pending', 'completed') AND NOT (
                    bo.check_out_date <= :checkin OR
                    bo.check_in_date >= :checkout
                )
            )";
            $params[':checkin'] = $filters['checkin'];
            $params[':checkout'] = $filters['checkout'];
        }

        $where = implode(' AND ', $conditions);

        $sql = "
            SELECT r.id, r.name, r.area, r.price, r.quant, r.adult, r.children, r.description, 
                rc.cover,
                GROUP_CONCAT(DISTINCT f.name) AS features,
                GROUP_CONCAT(DISTINCT fc.name) AS facilities
            FROM room r
            LEFT JOIN room_covers rc ON r.id = rc.id_room
            LEFT JOIN room_features rf ON r.id = rf.id_room
            LEFT JOIN features f ON rf.id_features = f.id
            LEFT JOIN room_facilities rfc ON r.id = rfc.id_room
            LEFT JOIN facilities fc ON rfc.id_facilities = fc.id
            WHERE $where
            GROUP BY r.id
            LIMIT :limit
        ";

        $stmt = $this->conn->prepare($sql);

        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }

        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }    

    public function getRoomById($id) {
        $query = "
            SELECT r.id, r.name, r.area, r.price, r.quant, r.adult, r.children, r.description, 
                   rc.cover,
                   GROUP_CONCAT(DISTINCT f.name) AS features,
                   GROUP_CONCAT(DISTINCT fc.name) AS facilities
            FROM room r
            LEFT JOIN room_covers rc ON r.id = rc.id_room
            LEFT JOIN room_features rf ON r.id = rf.id_room
            LEFT JOIN features f ON rf.id_features = f.id
            LEFT JOIN room_facilities rfc ON r.id = rfc.id_room
            LEFT JOIN facilities fc ON rfc.id_facilities = fc.id
            WHERE r.id = :id
        ";
    
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }    

    public function getRoomImagesById($id) {
        $query = "SELECT * FROM room_images WHERE id_room = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }    

    public function getRoomCoverById($id) {
        $query = "SELECT * FROM room_covers WHERE id_room = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getFilteredRooms() {
        $filters = [
            'children' => $_GET['children'] ?? null,
            'adults' => $_GET['adults'] ?? null,
            'facilities' => $_GET['facilities'] ?? [],
            'features' => $_GET['features'] ?? [],
            'checkin' => $_GET['checkin'] ?? null,
            'checkout' => $_GET['checkout'] ?? null,
        ];

        $conditions = ["r.status = 1"];
        $params = [];

        if (!empty($filters['adults'])) {
            $conditions[] = "r.adult >= :adults";
            $params[':adults'] = $filters['adults'];
        }

        if (!empty($filters['children'])) {
            $conditions[] = "r.children >= :children";
            $params[':children'] = $filters['children'];
        }

        if (!empty($filters['facilities']) && is_array($filters['facilities'])) {
            $facilityPlaceholders = [];
            foreach ($filters['facilities'] as $index => $facility) {
                $key = ":facility{$index}";
                $facilityPlaceholders[] = $key;
                $params[$key] = $facility;
            }
            $conditions[] = "EXISTS (
                SELECT 1
                FROM room_facilities rf3
                JOIN facilities fc3 ON rf3.id_facilities = fc3.id
                WHERE rf3.id_room = r.id AND fc3.name IN (" . implode(',', $facilityPlaceholders) . ")
            )";
        }

        if (!empty($filters['features']) && is_array($filters['features'])) {
            $featurePlaceholders = [];
            foreach ($filters['features'] as $index => $feature) {
                $key = ":feature{$index}";
                $featurePlaceholders[] = $key;
                $params[$key] = $feature;
            }
            $conditions[] = "EXISTS (
                SELECT 1
                FROM room_features rf2
                JOIN features f2 ON rf2.id_features = f2.id
                WHERE rf2.id_room = r.id AND f2.name IN (" . implode(',', $featurePlaceholders) . ")
            )";
        }

        if (!empty($filters['checkin']) && !empty($filters['checkout'])) {
            $conditions[] = "r.id NOT IN (
                SELECT bd.room_id
                FROM booking_details bd
                JOIN booking_order bo ON bd.booking_id = bo.booking_id
                WHERE bo.status IN ('pending', 'completed') AND NOT (
                    bo.check_out_date <= :checkin OR
                    bo.check_in_date >= :checkout
                )
            )";
            $params[':checkin'] = $filters['checkin'];
            $params[':checkout'] = $filters['checkout'];
        }

        $where = implode(' AND ', $conditions);

        $sql = "
            SELECT r.id, r.name, r.area, r.price, r.quant, r.adult, r.children, r.description, 
                rc.cover,
                GROUP_CONCAT(DISTINCT f.name) AS features,
                GROUP_CONCAT(DISTINCT fc.name) AS facilities
            FROM room r
            LEFT JOIN room_covers rc ON r.id = rc.id_room
            LEFT JOIN room_features rf ON r.id = rf.id_room
            LEFT JOIN features f ON rf.id_features = f.id
            LEFT JOIN room_facilities rfc ON r.id = rfc.id_room
            LEFT JOIN facilities fc ON rfc.id_facilities = fc.id
            WHERE $where
            GROUP BY r.id
        ";

        $stmt = $this->conn->prepare($sql);

        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

$database = new Database();
$db = $database->getConnection();

$roomObj = new Room($db);
$rooms = $roomObj->getFilteredRooms();
?>