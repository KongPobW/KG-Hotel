<?php
require(__DIR__ . '/../../public/db_config.php');

if (isset($_POST['get_booking'])) {
    $stmt = $conn->prepare("
        SELECT 
            bo.booking_id,
            r.name AS room_name,
            DATE(bo.booking_date) AS booking_date,
            DATE(bo.check_in_date) AS check_in_date,
            DATE(bo.check_out_date) AS check_out_date,
            bd.name AS booker_name,
            bd.num_nights,
            bo.total_amount,
            bd.pnumber,
            bo.status
        FROM 
            booking_order bo
        JOIN 
            booking_details bd ON bo.booking_id = bd.booking_id
        JOIN 
            user_cred uc ON bo.user_id = uc.sr_no
        JOIN 
            room r ON bd.room_id = r.id
        ORDER BY 
            bo.booking_date DESC
    ");
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($results);
    } else {
        echo json_encode(['error' => 'No booking found']);
    }
}

if (isset($_POST['complete_booking'])) {
    try {
        $bookingId = $_POST['booking_id'];

        $stmt = $conn->prepare("UPDATE booking_order SET status = 'completed' WHERE booking_id = ?");
        $stmt->execute([$bookingId]);

        if ($stmt->rowCount() > 0) {
            echo json_encode(['success' => 'Booking marked as completed!']);
        } else {
            echo json_encode(['error' => 'Failed to mark completed!']);
        }
    } catch (PDOException $e) {
        echo json_encode(["error" => $e->getMessage()]);
    }
}

if (isset($_POST['cancel_booking'])) {
    try {
        $bookingId = $_POST['booking_id'];

        $stmt = $conn->prepare("UPDATE booking_order SET status = 'cancelled' WHERE booking_id = ?");
        $stmt->execute([$bookingId]);

        if ($stmt->rowCount() > 0) {
            echo json_encode(['success' => 'Booking cancelled!']);
        } else {
            echo json_encode(['error' => 'Failed to cancel booking!']);
        }
    } catch (PDOException $e) {
        echo json_encode(["error" => $e->getMessage()]);
    }
}
?>