<?php
class Contact {
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

    public function insertMessage($name, $email, $subject, $message) {
        $query = "INSERT INTO user_contact (name, email, subject, message, date) VALUES (:name, :email, :subject, :message, :date)";
        $stmt = $this->conn->prepare($query);

        $date = date('Y-m-d');

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':subject', $subject);
        $stmt->bindParam(':message', $message);
        $stmt->bindParam(':date', $date);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function getMessages() {
        $query = "SELECT * FROM user_contact ORDER BY date DESC";
        $stmt = $this->conn->prepare($query);
        
        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        return [];
    }
}

$database = new Database();
$db = $database->getConnection();

$contact = new Contact($db);
$contact_info = $contact->getContactInfo();

$address = $contact_info['address'];
$pn1 = $contact_info['pn1'];
$pn2 = $contact_info['pn2'];
$email = $contact_info['email'];
$gmap = $contact_info['gmap'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $email_input = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    if ($contact->insertMessage($name, $email_input, $subject, $message)) {
        $success_msg = "Your message has been sent successfully!";
    } else {
        $error_msg = "There was an error sending your message! Please try again";
    }
}
?>