<?php
class Room {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getRooms() {
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
            WHERE r.status = 1
            GROUP BY r.id
        ";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getRoomsLimit($limit) {
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
            WHERE r.status = 1
            GROUP BY r.id
            LIMIT :limit
        ";
    
        $stmt = $this->conn->prepare($query);
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
}

$database = new Database();
$db = $database->getConnection();

$roomObj = new Room($db);
$rooms = $roomObj->getRooms();
?>