<?php
require(__DIR__ . '/../../public/db_config.php');

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

    if ($status != '') {
        echo $result;
    } else {
        session_start();

        $count_days = date_diff($checkin_date, $checkout_date)->days;
        $payment = $_SESSION['room']['price'] * $count_days;
        $_SESSION['room']['payment'] = $payment;
        $_SESSION['room']['available'] = true;

        $result = json_encode(["status" => "available", "days" => $count_days, "payment" => $payment]);
        echo $result;
    }
}
?>