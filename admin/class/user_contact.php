<?php
class UserContact {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
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
}

$database = new Database();
$db = $database->getConnection();

$user_contact = new UserContact($db);

$success_msg;
$error_msg;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $email_input = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

        if ($user_contact->insertMessage($name, $email_input, $subject, $message)) {
            $success_msg = "Your message has been sent successfully!";
        } else {
        $error_msg = "There was an error sending your message! Please try again";
    }
}
?>