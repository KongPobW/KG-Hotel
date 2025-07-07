<?php
require(__DIR__ . '/../../public/db_config.php');

session_start();

if (isset($_POST['check_availability'])) {
    $today_date = new DateTime(date("Y-m-d"));
    $checkin_date = new DateTime(trim($_POST['check_in']));
    $checkout_date = new DateTime(trim($_POST['check_out']));

    $status = "";
    $result = "";

    if ($checkin_date == $checkout_date) {
        $status = "check_in_out_equal";
        $result = json_encode(["status" => $status]);
    } else if ($checkin_date > $checkout_date) {
        $status = "check_out_earlier";
        $result = json_encode(["status" => $status]);
    } else if ($checkin_date < $today_date) {
        $status = "check_in_earlier";
        $result = json_encode(["status" => $status]);
    }

    if ($status !== "") {
        echo $result;
        exit;
    }

    $room_id = $_SESSION['room']['id'];

    $room_query = $conn->prepare("SELECT quant FROM room WHERE id = ?");
    $room_query->execute([$room_id]);
    $room = $room_query->fetch(PDO::FETCH_ASSOC);

    $room_quantity = $room['quant'];
    $room_price = $_SESSION['room']['price'];

    $checkin_str = $checkin_date->format("Y-m-d");
    $checkout_str = $checkout_date->format("Y-m-d");

    $booked_query = $conn->prepare("
        SELECT SUM(bd.num_nights > 0) AS total_booked
        FROM booking_order bo
        INNER JOIN booking_details bd ON bo.booking_id = bd.booking_id
        WHERE bd.room_id = ?
        AND bo.status IN ('pending', 'completed')
        AND (
            (bo.check_in_date < ? AND bo.check_out_date > ?) OR
            (bo.check_in_date >= ? AND bo.check_in_date < ?)
        )
    ");
    $booked_query->execute([
        $room_id,
        $checkout_str, $checkin_str,
        $checkin_str, $checkout_str
    ]);
    $result = $booked_query->fetch(PDO::FETCH_ASSOC);
    $booked_rooms = (int)$result['total_booked'];

    if ($booked_rooms >= $room_quantity) {
        echo json_encode(["status" => "unavailable"]);
        exit;
    }

    $count_days = date_diff($checkin_date, $checkout_date)->days;
    $final_payment = $room_price * $count_days;
    $_SESSION['room']['num_nights'] = $count_days;
    $_SESSION['room']['payment'] = $final_payment;
    $_SESSION['room']['available'] = true;

    $result = json_encode(["status" => "available", "days" => $count_days, "payment" => $final_payment]);
    echo $result;
}

if (isset($_POST['save_booking'])) {
    $name = trim($_POST['name'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $checkin_date = trim($_POST['check_in_date'] ?? '');
    $checkout_date = trim($_POST['check_out_date'] ?? '');

    $room_id = $_SESSION['room']['id'];
    $price_per_night = $_SESSION['room']['price'];
    $payment = $_SESSION['room']['payment'];
    $count_days = $_SESSION['room']['num_nights'];
    $current_date = date('Ymd');

    $slip = $_FILES['slip'];
    $ext = pathinfo($slip['name'], PATHINFO_EXTENSION);
    $allowed = ['jpg', 'jpeg', 'png', 'webp', 'pdf'];

    if (!in_array(strtolower($ext), $allowed)) {
        echo json_encode(["status" => "error", "message" => "Invalid Image Type!"]);
        exit;
    }

    $uploadDir = __DIR__ . '/../../uploads/payment_proofs/arrival/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    $fileName = 'slip_' . preg_replace('/[^a-zA-Z0-9]/', '', $_SESSION['user_name']) . '_' . $room_id . '_' . $current_date . '_' . uniqid() . '.' . $ext;
    $filePath = $uploadDir . $fileName;

    if (!move_uploaded_file($slip['tmp_name'], $filePath)) {
        echo json_encode(["status" => "error", "message" => "Failed to upload image slip!"]);
        exit;
    }

    try {
        $conn->beginTransaction();

        $stmt = $conn->prepare("INSERT INTO booking_order (user_id, booking_date, check_in_date, check_out_date, total_amount) 
                                VALUES (?, NOW(), ?, ?, ?)");
        $stmt->execute([$_SESSION['user_id'], $checkin_date, $checkout_date, $payment]);
        $booking_id = $conn->lastInsertId();

        $stmt = $conn->prepare("INSERT INTO booking_details (booking_id, room_id, price_per_night, num_nights, name, pnumber, address, subtotal)
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$booking_id, $room_id, $price_per_night, $count_days, $name, $phone, $address, $payment]);

        $stmt = $conn->prepare("INSERT INTO payment_proof (booking_id, payment_date, amount_paid, proof_file_arrival)
                                VALUES (?, NOW(), ?, ?)");
        $stmt->execute([$booking_id, $payment, $fileName]);

        $stmt = $conn->prepare("UPDATE room SET quant = quant - 1 WHERE id = ? AND quant > 0");
        $stmt->execute([$room_id]);

        $conn->commit();

        echo json_encode(["status" => "success", "booking_id" => $booking_id]);
    } catch (Exception $e) {
        $conn->rollBack();
        echo json_encode(["status" => "error", "message" => $e->getMessage()]);
    }
}
?>