<?php
header('Content-Type: application/json');

if (isset($_POST['create_promptpay'])) {
    session_start();
    
    $phone = trim($_POST['phone'] ?? '0982592063');
    $amount = floatval($_SESSION['room']['payment'] ?? 0);

    $baseUrl = 'https://promptpay.io/';
    $qrUrl = $baseUrl . urlencode($phone);
    if ($amount > 0) {
        $qrUrl .= '/' . number_format($amount, 2, '.', '');
    }

    echo json_encode(['qr_url' => $qrUrl]);
}
?>