<?php
require '../../vendor/autoload.php';

session_start();

define('OMISE_PUBLIC_KEY', 'pkey_test_648cyvhz9d9fwwhhed9');
define('OMISE_SECRET_KEY', 'skey_test_648cyvifnias4z45t42');

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['generate_promptpay'])) {
    $paymentThb = $_SESSION['room']['payment'] ?? null;
    
    if (!is_numeric($paymentThb) || $paymentThb <= 0) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Invalid or missing payment amount'
        ]);
        exit;
    }

    $amountSatang = intval($paymentThb * 100);

    try {
        $charge = OmiseCharge::create([
            'amount' => $amountSatang,
            'currency' => 'thb',
            'source' => ['type' => 'promptpay'],
            'return_uri' => 'http://localhost/kg-hotel/thankyou.php'
        ]);

        echo json_encode([
            'status' => 'success',
            'qr_url' => $charge['source']['scannable_code']['image']['download_uri']
        ]);
    } catch (Exception $e) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Failed to create charge: ' . $e->getMessage()
        ]);
    }
}