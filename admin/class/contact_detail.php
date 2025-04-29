<?php
class ContactDetail {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getContactInfo() {
        $query = "SELECT * FROM contact_details WHERE sr_no = 1";
        $stmt = $this->conn->prepare($query);

        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

$database = new Database();
$db = $database->getConnection();

$contact_detail = new ContactDetail($db);
$contact_info = $contact_detail->getContactInfo();

$address = $contact_info['address'];
$pn1 = $contact_info['pn1'];
$pn2 = $contact_info['pn2'];
$email = $contact_info['email'];
$gmap = $contact_info['gmap'];
?>