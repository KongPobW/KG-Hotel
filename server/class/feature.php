<?php
class Feature {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getFeatures() {
        $query = "SELECT * FROM features ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

$database = new Database();
$db = $database->getConnection();

$featureObj = new Feature($db);
$features = $featureObj->getFeatures();
?>