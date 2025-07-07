<?php
require(__DIR__ . '/../../public/db_config.php');

if (isset($_POST['get_payment_proof'])) {
    $stmt = $conn->prepare("
        SELECT 
            bd.pnumber,
            bd.subtotal,
            bd.name AS booker_name,
            bo.booking_date,
            pp.payment_id,
            pp.proof_file_arrival,
            pp.proof_file_refund,
            pp.verified,
            pp.verified_at,
            bo.status
        FROM booking_details bd
        JOIN booking_order bo ON bd.booking_id = bo.booking_id
        LEFT JOIN room r ON r.id = bd.room_id
        LEFT JOIN payment_proof pp ON bo.booking_id = pp.booking_id
    ");
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($results);
    } else {
        echo json_encode(['error' => 'No payment proof found']);
    }
}

if (isset($_POST['verify_payment'])) {
    $payment_id = $_POST['payment_id'];

    try {
        $conn->beginTransaction();
        
        $stmt1 = $conn->prepare("UPDATE payment_proof SET verified = 1, verified_at = NOW() WHERE payment_id = ?");
        $stmt1->execute([$payment_id]);

        $stmt2 = $conn->prepare("SELECT booking_id FROM payment_proof WHERE payment_id = ?");
        $stmt2->execute([$payment_id]);
        $booking = $stmt2->fetch(PDO::FETCH_ASSOC);

        if ($booking && isset($booking['booking_id'])) {
            $stmt3 = $conn->prepare("UPDATE booking_order SET status = 'completed' WHERE booking_id = ?");
            $stmt3->execute([$booking['booking_id']]);
        }

        $conn->commit();
        echo json_encode(['success' => true]);
    } catch (Exception $e) {
        $conn->rollBack();
        echo json_encode(['success' => false]);
    }
}

if (isset($_POST['upload_refund_slip'])) {
    $payment_id = $_POST['payment_id'];
    $file = $_FILES['refund_slip_file'];

    $allowedTypes = ['image/jpeg', 'image/png', 'application/pdf'];
    if (!in_array($file['type'], $allowedTypes)) {
        echo json_encode(['success' => false, 'error' => 'Invalid file type']);
        exit;
    }

    $uploadDir = __DIR__ . '/../../uploads/payment_proofs/refund/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    $filename = "slip_refund_" . time() . '_' . basename($file['name']);
    $targetFile = $uploadDir . $filename;

    if (move_uploaded_file($file['tmp_name'], $targetFile)) {
        try {
            $conn->beginTransaction();

            $stmt1 = $conn->prepare("UPDATE payment_proof SET proof_file_refund = ? WHERE payment_id = ?");
            $stmt1->execute([$filename, $payment_id]);

            $stmt2 = $conn->prepare("SELECT booking_id FROM payment_proof WHERE payment_id = ?");
            $stmt2->execute([$payment_id]);
            $booking = $stmt2->fetch(PDO::FETCH_ASSOC);

            if ($booking && isset($booking['booking_id'])) {
                $stmt3 = $conn->prepare("UPDATE booking_order SET status = 'cancelled' WHERE booking_id = ?");
                $stmt3->execute([$booking['booking_id']]);
            }

            $conn->commit();
            echo json_encode(['success' => true]);

        } catch (Exception $e) {
            $conn->rollBack();
            echo json_encode(['success' => false]);
        }
    }
}
?>