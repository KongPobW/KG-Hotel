<?php
require('../public/db_config.php');

if (isset($_POST['send_message'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $subject = trim($_POST['subject']);
    $message = trim($_POST['message']);
    $date = date('Y-m-d');

    $query = $conn->prepare("INSERT INTO user_contact (name, email, subject, message, date) VALUES (?, ?, ?, ?, ?)");
    $res = $query->execute([$name, $email, $subject, $message, $date]);
    
    echo $res ? 1 : 0;
}
?>