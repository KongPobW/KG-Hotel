<?php
class Facility {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getFacilities() {
        $query = "SELECT * FROM facilities ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getFacilitiesLimit($limit) {
        $query = "SELECT * FROM facilities ORDER BY id DESC LIMIT :limit";
    
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }    
}

$database = new Database();
$db = $database->getConnection();

$facilityObj = new Facility($db);
$facilities = $facilityObj->getFacilities();
?>