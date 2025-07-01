<?php
require('public/db_config.php');
require('server/class/contact_detail.php');
require('server/class/room.php');
require('server/class/setting.php');
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KG Hotel - Confirm Booking</title>
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
    <?php require('public/utils.php'); ?>
    <?php require('inc/modal.php'); ?>

    <?php require('inc/shutdown_alert.php'); ?>

    <?php
    if (!isset($_GET['id']) || !is_numeric($_GET['id']) || $shutdown == true) {
        redirect('rooms.php');
    } else if (!(isset($_SESSION['user_id']))) {
        redirect('rooms.php');
    }
    
    $room_id = $_GET['id'];
    $roomObj = new Room($db);
    $room = $roomObj->getRoomById($room_id);

    $_SESSION['room'] = [
        "id" => $room['id'],
        "name" => $room['name'],
        "price" => $room['price'],
        "payment" => null,
        "available" => false,
    ];
    ?>

    <div class="container">
        <div class="row">
            <div class="col-12 my-5 mb-4 px-4">
                <h2 class="fw-bold">CONFIRM BOOKING</h2>
                <div style="font-size: 15px;">
                    <a href="index.php" class="text-secondary text-decoration-none">HOME</a>
                    <span class="text-secondary"> > </span>
                    <a href="rooms.php" class="text-secondary text-decoration-none">ROOMS</a>
                    <span class="text-secondary"> > </span>
                    <a href="#" class="text-secondary text-decoration-none">CONFIRM</a>
                </div>
            </div>

            <div class="col-lg-7 col-md-12 px-4">
                <?php 
                    $roomImages = $roomObj->getRoomImagesById($room_id);
                    $roomCovers = $roomObj->getRoomCoverById($room_id);
                    $roomCover = !empty($roomCovers) ? $roomCovers[0] : null;

                    if (!empty($roomCover)) {
                        $imagePath = 'uploads/rooms/covers/' . htmlspecialchars($roomCover['cover']);
                        echo '<div class="card p-3 shadow-sm rounded">';
                        echo '<img src="' . $imagePath . '" class="img-fluid rounded mb-3">';
                        echo '<h5>' . htmlspecialchars($room['name']) . "</h5>";
                        echo '<h6>฿' . htmlspecialchars($room['price']) . " per night</h6>";
                        echo '</div>';
                    }
                ?>
            </div>

            <div class="col-lg-5 col-md-12 px-4">
                <div class="card mb-4 border-0 shadow-sm rounded-3">
                    <div class="card-body">
                        <form id="booking-form" action="#">
                            <h6 class="mb-3">BOOKING DETAILS</h6>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" name="name"
                                        value="<?php echo htmlspecialchars($_SESSION['user_name']); ?>"
                                        id="name-input-confirm" class="form-control shadow-none" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Phone</label>
                                    <input type="text" name="phone"
                                        value="<?php echo htmlspecialchars($_SESSION['user_data']['pnumber']); ?>"
                                        id="phone-input-confirm" class="form-control shadow-none" required>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Address</label>
                                    <textarea name="address" id="address-input-confirm" class="form-control shadow-none"
                                        required><?php echo htmlspecialchars($_SESSION['user_data']['address']); ?></textarea>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Check-In</label>
                                    <input type="date" name="check-in" id="check-in-input-confirm"
                                        onchange="checkAvailability()" class="form-control shadow-none" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Check-Out</label>
                                    <input type="date" name="check-out" id="check-out-input-confirm"
                                        onchange="checkAvailability()" class="form-control shadow-none" required>
                                </div>
                                <div class="col-12">
                                    <h6 class="mb-3 text-danger" id="pay-info">Provide check-in & check-out date!</h6>
                                    <button type="button" name="pay-now"
                                        class="btn w-100 text-white custom-bg shadow-none"
                                        onclick="createPromptPay()">Pay Now</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require('inc/footer.php'); ?>
    <?php require('inc/user_success.php'); ?>
    <?php require('public/script.php'); ?>

    <script src="server/js/user.js"></script>
    <script src="server/js/confirm_booking.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous">
    </script>
</body>

</html>