<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <?php require('public/link.php'); ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="css/style.css" />
    <title>Thank You for Your Payment</title>
    <style>
    body {
        background: linear-gradient(135deg, #f8fafc, #e9ecef);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .thank-you-card {
        max-width: 480px;
        width: 90%;
        padding: 2.5rem 2rem;
        border-radius: 1rem;
        box-shadow: 0 12px 25px rgb(0 0 0 / 0.15);
        background: #fff;
        text-align: center;
    }

    h1 {
        font-weight: 700;
        font-size: 2.25rem;
        margin-bottom: 1rem;
        color: #28a745;
    }

    p.lead {
        font-size: 1.125rem;
        color: #555;
    }

    p.booking-id {
        margin-top: 1.5rem;
        font-size: 1.125rem;
        font-weight: 600;
        color: #333;
    }

    @media (max-width: 576px) {
        .thank-you-card {
            padding: 2rem 1.5rem;
        }

        h1 {
            font-size: 1.8rem;
        }

        p.lead,
        p.booking-id {
            font-size: 1rem;
        }
    }
    </style>
</head>

<body class="d-flex justify-content-center align-items-center vh-100">
    <div class="thank-you-card">
        <h1><i class="bi bi-check-circle-fill"></i> Thank You</h1>

        <p class="lead">Please wait for 1-2 days while verifying your payment</p>

        <p>Once verified, your booking status will be updated to <strong>"Completed"</strong></p>

        <?php if (isset($_GET['booking_id']) && !empty($_GET['booking_id'])): ?>
        <p class="booking-id">Your booking ID is: <strong><?php echo htmlspecialchars($_GET['booking_id']); ?></strong>
        </p>
        <?php else: ?>
        <p class="booking-id text-muted">Booking ID is not available.</p>
        <?php endif; ?>

        <a href="index.php" class="btn btn-success btn-home">Back to Home</a>
    </div>

    <?php require('public/script.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous">
    </script>
</body>

</html>