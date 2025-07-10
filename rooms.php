<?php
require('public/db_config.php');
require('server/class/contact_detail.php');
require('server/class/room.php');
require('server/class/facility.php');
require('server/class/feature.php');
require('server/class/setting.php');
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KG Hotel - Rooms</title>
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

    <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center">OUR ROOMS</h2>
        <div class="h-line bg-dark"></div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-12 mb-4 mb-lg-0 px-lg-0">
                <nav class="navbar navbar-expand-lg navbar-light bg-white rounded lg-shadow">
                    <div class="container-fluid flex-lg-column align-items-stretch">
                        <h4 class="mt-2 d-none d-lg-block">FILTERS</h4>
                        <button class="navbar-toggler shadow-none mb-lg-2" type="button" data-bs-toggle="collapse"
                            data-bs-target="#filter-dropdown" aria-controls="filter-dropdown" aria-expanded="false"
                            aria-label="ToggleFilter">
                            <span class="navbar-toggler-icon"></span> FILTERS
                        </button>

                        <div class="collapse navbar-collapse flex-column align-items-stretch mt-2" id="filter-dropdown">
                            <form method="GET" class="w-100">
                                <div class="border bg-light p-3 rounded mb-3">
                                    <h5 class="mb-3" style="font-size: 18px;">CHECK AVAILABILITY</h5>
                                    <label class="form-label">Check-In</label>
                                    <input type="date" name="checkin" value="<?= $_GET['checkin'] ?? '' ?>"
                                        class="form-control shadow-none mb-3">
                                    <label class="form-label">Check-Out</label>
                                    <input type="date" name="checkout" value="<?= $_GET['checkout'] ?? '' ?>"
                                        class="form-control shadow-none">
                                </div>

                                <div class="border bg-light p-3 rounded mb-3">
                                    <h5 class="mb-3" style="font-size: 18px;">FACILITIES</h5>
                                    <?php foreach ($facilities as $f): ?>
                                    <div class="mb-2">
                                        <input type="checkbox" id="fac_<?= $f['id'] ?>" name="facilities[]"
                                            value="<?= $f['name'] ?>" class="form-check-input shadow-none me-1"
                                            <?= (isset($_GET['facilities']) && in_array($f['name'], $_GET['facilities'])) ? 'checked' : '' ?>>
                                        <label class="form-check-label"
                                            for="fac_<?= $f['id'] ?>"><?= $f['name'] ?></label>
                                    </div>
                                    <?php endforeach; ?>
                                </div>

                                <div class="border bg-light p-3 rounded mb-3">
                                    <h5 class="mb-3" style="font-size: 18px;">FEATURES</h5>
                                    <?php foreach ($features as $feature): ?>
                                    <div class="mb-2">
                                        <input type="checkbox" id="feat_<?= $feature['id'] ?>" name="features[]"
                                            value="<?= $feature['name'] ?>" class="form-check-input shadow-none me-1"
                                            <?= (isset($_GET['features']) && in_array($feature['name'], $_GET['features'])) ? 'checked' : '' ?>>
                                        <label class="form-check-label"
                                            for="feat_<?= $feature['id'] ?>"><?= $feature['name'] ?></label>
                                    </div>
                                    <?php endforeach; ?>
                                </div>

                                <div class="border bg-light p-3 rounded mb-3">
                                    <h5 class="mb-3" style="font-size: 18px;">GUESTS</h5>
                                    <div class="d-flex justify-content-between gap-3">
                                        <div class="w-100">
                                            <label class="form-label">Adults</label>
                                            <select name="adults" class="form-select shadow-none">
                                                <?php for ($i = 1; $i <= 10; $i++): ?>
                                                <option value="<?= $i ?>"
                                                    <?= (isset($_GET['adults']) && $_GET['adults'] == $i) ? 'selected' : '' ?>>
                                                    <?= $i ?></option>
                                                <?php endfor; ?>
                                            </select>
                                        </div>
                                        <div class="w-100">
                                            <label class="form-label">Children</label>
                                            <select name="children" class="form-select shadow-none">
                                                <?php for ($i = 0; $i <= 10; $i++): ?>
                                                <option value="<?= $i ?>"
                                                    <?= (isset($_GET['children']) && $_GET['children'] == $i) ? 'selected' : '' ?>>
                                                    <?= $i ?></option>
                                                <?php endfor; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-grid gap-2 mb-3">
                                    <button type="submit" class="btn btn-sm btn-primary">Filter</button>
                                    <a href="rooms.php" class="btn btn-sm btn-outline-secondary">Clear</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </nav>
            </div>

            <div class="col-lg-9 col-md-12 px-4">
                <?php if (empty($rooms)): ?>
                <div class="alert alert-warning text-center d-flex align-items-center justify-content-center gap-2 mb-0" role="alert">
                    <i class="bi bi-exclamation-triangle-fill fs-4"></i>
                    <div>
                        <strong>No rooms found</strong> based on your selected filters
                    </div>
                </div>
                <?php else: ?>
                <?php foreach ($rooms as $room): ?>
                <div class="card mb-4 border-0 shadow">
                    <div class="row g-0 p-3 align-items-center">
                        <div class="col-md-5 mb-lg-0 mb-md-0 mb-3">
                            <img src="uploads/rooms/covers/<?php echo $room['cover']; ?>"
                                class="img-fluid rounded w-100 h-100 object-fit-cover">
                        </div>
                        <div class="col-md-5 px-lg-3 px-md-3 px-0">
                            <h5 class="mb-3"><?php echo $room['name']; ?></h5>
                            <div class="features mb-3">
                                <h6 class="mb-1">Features</h6>
                                <?php 
                                $features = explode(',', $room['features']);
                                foreach ($features as $feature):
                                ?>
                                <span
                                    class="badge rounded-pill text-bg-light text-wrap lh-base mt-2"><?php echo $feature; ?></span>
                                <?php endforeach; ?>
                            </div>
                            <div class="facilities mb-3">
                                <h6 class="mb-1">Facilities</h6>
                                <?php 
                                $facilities = explode(',', $room['facilities']);
                                foreach ($facilities as $facility):
                                ?>
                                <span
                                    class="badge rounded-pill text-bg-light text-wrap lh-base mt-2"><?php echo $facility; ?></span>
                                <?php endforeach; ?>
                            </div>
                            <div class="guests">
                                <h6 class="mb-1">Guests</h6>
                                <span
                                    class="badge rounded-pill text-bg-light text-wrap lh-base mt-2"><?php echo $room['adult']; ?>
                                    Adults</span>
                                <span
                                    class="badge rounded-pill text-bg-light text-wrap lh-base mt-2"><?php echo $room['children']; ?>
                                    Children</span>
                            </div>
                        </div>
                        <div class="col-md-2 text-center">
                            <h6 class="my-4 mt-lg-0 mt-md-0">฿<?php echo number_format($room['price'], 0); ?> per night
                            </h6>
                            <?php if ($shutdown != 1): ?>
                            <?php if (isset($_SESSION['user_id'])): ?>
                                <a href="confirm_booking.php?id=<?php echo $room['id']; ?>" class="btn btn-sm w-100 text-white custom-bg shadow-none mb-2">Book Now</a>
                            <?php else: ?>
                            <button type="button" class="btn btn-sm w-100 text-white custom-bg shadow-none mb-2"
                                data-bs-toggle="modal" data-bs-target="#loginModal">
                                Book Now
                            </button>
                            <?php endif; ?>
                            <?php endif; ?>
                            <a href="room_detail.php?id=<?php echo $room['id']; ?>"
                                class="btn btn-sm w-100 btn-outline-dark shadow-none">Details</a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php require('inc/footer.php'); ?>
    <?php require('inc/user_success.php'); ?>
    <?php require('public/script.php'); ?>

    <script src="server/js/user.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous">
    </script>
</body>

</html>