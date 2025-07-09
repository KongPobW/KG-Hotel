<?php
require(__DIR__ . '/../../public/db_config.php');

if (isset($_POST['request_refund'])) {
    $bookingId = $_POST['booking_id'];

    try {
        $update = $conn->prepare("UPDATE booking_order SET status = 'refunding' WHERE booking_id = ?");
        $update->execute([$bookingId]);

        if ($update->rowCount() > 0) {
            echo json_encode(['success' => 'Refund request submitted successfully!']);
        } else {
            echo json_encode(['error' => 'Failed to request refund!']);
        }

    } catch (PDOException $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
}
?>