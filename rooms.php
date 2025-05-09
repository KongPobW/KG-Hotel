<?php
require('admin/inc/db_config.php');
require('admin/class/room.php');
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KG Hotel - Rooms</title>
    <?php require('inc/link.php'); ?>
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

    <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center">OUR ROOMS</h2>
        <div class="h-line bg-dark"></div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-12 mb-4 mb-lg-0 px-lg-0">
                <nav class="navbar navbar-expand-lg navbar-light bg-white rounded shadow">
                    <div class="container-fluid flex-lg-column align-items-stretch">
                        <h4 class="mt-2">FILTERS</h4>
                        <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse"
                            data-bs-target="#filter-dropdown" aria-controls="navbarNav" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse flex-column align-items-stretch mt-2" id="filter-dropdown">
                            <div class="border bg-light p-3 rounded mb-3">
                                <h5 class="mb-3" style="font-size: 18px;">CHECK AVAILABILITY</h5>
                                <label class="form-label">Check-In</label>
                                <input type="date" class="form-control shadow-none mb-3">
                                <label class="form-label">Check-Out</label>
                                <input type="date" class="form-control shadow-none">
                            </div>

                            <div class="border bg-light p-3 rounded mb-3">
                                <h5 class="mb-3" style="font-size: 18px;">FACILITIES</h5>
                                <div class="mb-2">
                                    <input type="checkbox" id="f1" class="form-check-input shadow-none me-1">
                                    <label class="form-check-label" for="f1">Facility 1</label>
                                </div>
                                <div class="mb-2">
                                    <input type="checkbox" id="f2" class="form-check-input shadow-none me-1">
                                    <label class="form-check-label" for="f2">Facility 2</label>
                                </div>
                                <div class="mb-2">
                                    <input type="checkbox" id="f3" class="form-check-input shadow-none me-1">
                                    <label class="form-check-label" for="f3">Facility 3</label>
                                </div>
                            </div>

                            <div class="border bg-light p-3 rounded mb-3">
                                <h5 class="mb-3" style="font-size: 18px;">GUESTS</h5>
                                <div class="d-flex justify-content-between gap-3">
                                    <div class="w-100">
                                        <label class="form-label">Adults</label>
                                        <select class="form-select shadow-none">
                                            <option value="1" selected>1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                    <div class="w-100">
                                        <label class="form-label">Children</label>
                                        <select class="form-select shadow-none">
                                            <option value="1" selected>1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>

            <div class="col-lg-9 col-md-12 px-4">
                <?php foreach ($rooms as $room): ?>
                <div class="card mb-4 border-0 shadow">
                    <div class="row g-0 p-3 align-items-center">
                        <div class="col-md-5 mb-lg-0 mb-md-0 mb-3">
                            <img src="admin/uploads/rooms/covers/<?php echo $room['cover']; ?>"
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
                            <a href="#" class="btn btn-sm w-100 text-white custom-bg shadow-none mb-2">Book Now</a>
                            <a href="room_detail.php?id=<?php echo $room['id']; ?>"
                                class="btn btn-sm w-100 btn-outline-dark shadow-none">Details</a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <?php require('inc/footer.php'); ?>
    <?php require('inc/user_success.php'); ?>
    <?php require('admin/inc/script.php'); ?>

    <script src="admin/server/user.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous">
    </script>
</body>

</html>