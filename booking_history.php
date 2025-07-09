<?php
session_start();
$user_id = $_SESSION['user_id'];

require('public/db_config.php');
require('server/class/booking_history.php');
require('server/class/contact_detail.php');
require('server/class/setting.php');
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KG Hotel - Booking History</title>
    <?php require('public/link.php'); ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
    .custom-alert {
        position: fixed;
        top: 80px;
        right: 25px;
        z-index: 1;
    }
    </style>
</head>

<body>
    <?php require('inc/header.php'); ?>
    <?php require('inc/modal.php'); ?>
    <?php require('inc/shutdown_alert.php'); ?>

    <div class="container my-5">
        <h3 class="mb-4">Your Booking History</h3>

        <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success">
            <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
        </div>
        <?php endif; ?>

        <?php if (empty($bookings)): ?>
        <div class="alert alert-info">No bookings found</div>
        <?php else: ?>
        <?php foreach ($bookings as $booking): ?>
        <div class="card shadow-sm border-0 mb-4">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="uploads/rooms/covers/<?php echo $booking['cover']; ?>" alt="Room Cover"
                        class="img-fluid rounded-start h-100 object-fit-cover" style="object-fit: cover;">
                </div>
                <div class="col-md-8">
                    <div class="card-body d-flex flex-column justify-content-between h-100">
                        <div>
                            <h5 class="card-title fw-bold mb-3 text-truncate">
                                <?php echo htmlspecialchars($booking['room_name']); ?>
                            </h5>
                            <div class="row mb-3">
                                <div class="col-6 col-sm-6">
                                    <p class="text-muted small mb-1">
                                        <i class="bi bi-hash me-1"></i> Booking ID:
                                        <strong><?php echo htmlspecialchars($booking['booking_id']); ?></strong>
                                    </p>
                                </div>
                                <div class="col-6 col-sm-6 text-md-end">
                                    <p class="text-muted small mb-1">
                                        <i class="bi bi-clock-history me-1"></i> Booking Date:
                                        <strong><?php echo date('d/m/Y', strtotime($booking['booking_date'])); ?></strong>
                                    </p>
                                </div>
                            </div>
                            <p class="text-muted small mb-3 text-truncate">
                                <i class="bi bi-person-fill me-1"></i>
                                <strong><?php echo htmlspecialchars($booking['booker_name']); ?></strong>
                            </p>
                            <div class="row mb-3">
                                <div class="col-6 col-sm-6">
                                    <i class="bi bi-calendar-check me-1 text-success"></i>
                                    <strong class="small">Check-In:</strong>
                                    <span class="text-muted small">
                                        <?php echo date('d/m/Y', strtotime($booking['check_in_date'])); ?>
                                    </span>
                                </div>
                                <div class="col-6 col-sm-6">
                                    <i class="bi bi-calendar-x me-1 text-danger"></i>
                                    <strong class="small">Check-Out:</strong>
                                    <span class="text-muted small">
                                        <?php echo date('d/m/Y', strtotime($booking['check_out_date'])); ?>
                                    </span>
                                </div>
                            </div>
                            <p class="mb-3">
                                <strong class="small">Total:</strong>
                                <span class="text-success">
                                    ฿<?php echo number_format($booking['total_amount'], 0); ?>
                                </span>
                            </p>
                            <p class="mb-0 small">
                                <strong>Status:</strong>
                                <?php
                                $status = $booking['status'];
                                $status_badges = [
                                    'pending'   => '<span class="badge bg-secondary">Pending</span>',
                                    'completed' => '<span class="badge bg-success">Completed</span>',
                                    'cancelled' => '<span class="badge bg-danger">Cancelled</span>',
                                    'refunding' => '<span class="badge bg-warning text-dark">Refund Requested</span>'
                                ];
                                echo $status_badges[$status] ?? '<span class="badge bg-dark">Unknown</span>';
                            ?>
                            </p>
                        </div>
                        <?php if ($booking['status'] !== 'refunding' && $booking['status'] !== 'cancelled'): ?>
                        <div class="mt-3">
                            <form>
                                <button type="button" class="btn btn-outline-danger btn-sm w-100"
                                    onclick="requestRefund('<?php echo htmlspecialchars($booking['booking_id']); ?>')">
                                    <i class="bi bi-arrow-counterclockwise me-1"></i> Request Refund
                                </button>
                            </form>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <?php require('inc/footer.php'); ?>
    <?php require('inc/user_success.php'); ?>
    <?php require('public/script.php'); ?>

    <script src="server/js/user.js"></script>
    <script src="server/js/booking_history.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous">
    </script>
</body>

</html>