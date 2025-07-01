<?php
require '../../vendor/autoload.php';

Omise::setPublicKey('pkey_test_648cyvhz9d9fwwhhed9');
Omise::setSecretKey('skey_test_648cyvifnias4z45t42');

$chargeId = $_GET['charge'] ?? null;

if (!$chargeId) {
    die('Charge ID is missing');
}

try {
    $charge = OmiseCharge::retrieve($chargeId);
    $status = $charge['status'];

    $isSuccess = ($status === 'successful');
} catch (Exception $e) {
    die('Failed to retrieve charge status: ' . htmlspecialchars($e->getMessage()));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Thank You</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" />
    <style>
    body {
        background-color: #f6f9fc;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
    }

    .thank-you-box {
        padding: 40px;
        border-radius: 16px;
        background: #fff;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        text-align: center;
        max-width: 400px;
    }
    </style>
</head>

<body>
    <div class="thank-you-box">
        <?php if ($isSuccess): ?>
        <h1 class="text-success">🎉 Thank You!</h1>
        <p>Your payment was received successfully.</p>
        <p><strong>Amount:</strong> <?= number_format($charge['amount'] / 100, 2) ?> THB</p>
        <p><strong>Charge ID:</strong> <?= htmlspecialchars($charge['id']) ?></p>
        <a href="index.php" class="btn btn-primary mt-3">Back to Home</a>
        <?php else: ?>
        <h1 class="text-danger">Payment Not Completed</h1>
        <p>Status: <?= htmlspecialchars($status) ?></p>
        <a href="index.php" class="btn btn-secondary mt-3">Back to Home</a>
        <?php endif; ?>
    </div>
</body>

</html>