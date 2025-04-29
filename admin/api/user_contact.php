<?php
require('../inc/db_config.php');
require('../../inc/utils.php');

if (isset($_POST['get_messages'])) {
    $stmt = $conn->prepare("SELECT * FROM user_contact");
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($messages);
    } else {
        echo json_encode(['error' => 'No messages found']);
    }
}

if (isset($_POST['update_message_status'])) {
    $messageId = $_POST['message_id'] ?? '';

    if (!empty($messageId)) {
        $stmt = $conn->prepare("UPDATE user_contact SET seen = 1 WHERE sr_no = ?");
        $result = $stmt->execute([$messageId]);

        echo $result ? '1' : '0';
    } else {
        echo '0';
    }
}
?>