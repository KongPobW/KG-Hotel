<?php
require('admin/inc/db_config.php');
require('admin/class/room.php');
require('admin/class/facility.php');
require('admin/class/contact_detail.php');
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KG Hotel - Home</title>
    <?php require('inc/link.php'); ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php require('inc/header.php'); ?>
    <?php require('inc/modal.php'); ?>

    <!-- carousel header -->
    <div class="container-fluid">
        <div class="swiper swiper-container">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img src="images/carousel/1.png" class="w-100 d-block">
                </div>
                <div class="swiper-slide">
                    <img src="images/carousel/2.png" class="w-100 d-block">
                </div>
                <div class="swiper-slide">
                    <img src="images/carousel/3.png" class="w-100 d-block">
                </div>
                <div class="swiper-slide">
                    <img src="images/carousel/4.png" class="w-100 d-block">
                </div>
            </div>
        </div>
    </div>
    <!-- check booking availability -->
    <div class="container availability-form">
        <div class="row">
            <div class="col-lg-12 bg-white shadow p-4 rounded">
                <h5 class="mb-3">Check Booking Availability</h5>
                <form>
                    <div class="row align-items-end">
                        <div class="col-lg-3 mb-3">
                            <label class="form-label" style="font-weight: 500;">Check-In</label>
                            <input type="date" class="form-control shadow-none">
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label class="form-label" style="font-weight: 500;">Check-Out</label>
                            <input type="date" class="form-control shadow-none">
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label class="form-label" style="font-weight: 500;">Adult</label>
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
                        <div class="col-lg-3 mb-3">
                            <label class="form-label" style="font-weight: 500;">Children</label>
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
                        <div class="col-lg-1 mb-lg-3 mt-2">
                            <button type="submit" class="btn text-white shadow-none custom-bg">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- our rooms -->
    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">OUR ROOMS</h2>
    <div class="container">
        <div class="row">
            <?php $rooms = $roomObj->getRoomsLimit(3); ?>
            <?php foreach ($rooms as $room): ?>
            <div class="col-lg-4 col-md-6 my-3">
                <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
                    <img src="admin/uploads/rooms/covers/<?= htmlspecialchars($room['cover']) ?>" class="card-img-top"
                        alt="<?= htmlspecialchars($room['name']) ?>">
                    <div class="card-body">
                        <h5><?= htmlspecialchars($room['name']) ?></h5>
                        <h6 class="mb-4">฿<?= number_format($room['price']) ?> per night</h6>

                        <div class="features mb-4">
                            <h6 class="mb-1">Features</h6>
                            <?php foreach (explode(',', $room['features']) as $feature): ?>
                            <span
                                class="badge rounded-pill text-bg-light text-wrap lh-base"><?= htmlspecialchars($feature) ?></span>
                            <?php endforeach; ?>
                        </div>

                        <div class="facilities mb-4">
                            <h6 class="mb-1">Facilities</h6>
                            <?php foreach (explode(',', $room['facilities']) as $facility): ?>
                            <span
                                class="badge rounded-pill text-bg-light text-wrap lh-base"><?= htmlspecialchars($facility) ?></span>
                            <?php endforeach; ?>
                        </div>

                        <div class="guests mb-4">
                            <h6 class="mb-1">Guests</h6>
                            <span class="badge rounded-pill text-bg-light text-wrap lh-base"><?= (int)$room['adult'] ?>
                                Adults</span>
                            <span
                                class="badge rounded-pill text-bg-light text-wrap lh-base"><?= (int)$room['children'] ?>
                                Children</span>
                        </div>

                        <div class="d-flex mb-2 gap-2">
                            <a href="book.php?room_id=<?= $room['id'] ?>"
                                class="btn btn-sm text-white custom-bg shadow-none">Book Now</a>
                            <a href="room_details.php?id=<?= $room['id'] ?>"
                                class="btn btn-sm btn-outline-dark shadow-none">Details</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>

            <div class="col-lg-12 text-center mt-5">
                <a href="rooms.php" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">More Rooms ></a>
            </div>
        </div>
    </div>
    <!-- our facilities -->
    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">OUR FACILITIES</h2>
    <div class="container">
        <div class="row justify-content-between px-lg-0 px-md-0 px-5">
            <?php $facilities = $facilityObj->getFacilitiesLimit(5); ?>
            <?php foreach ($facilities as $facility): ?>
            <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
                <img src="admin/uploads/facilities/<?= htmlspecialchars($facility['icon']) ?>" width="80px">
                <h5 class="mt-3"><?= htmlspecialchars($facility['name']) ?></h5>
            </div>
            <?php endforeach; ?>

            <div class="col-lg-12 text-center mt-5">
                <a href="facilities.php" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">More
                    Facilities ></a>
            </div>
        </div>
    </div>
    <!-- reach us -->
    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">REACH US</h2>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8 p-4 mb-lg-0 mb-3 bg-white rounded">
                <iframe class="w-100 rounded" src="<?= $gmap ?>" height="320" loading="lazy"></iframe>
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="bg-white p-4 rounded mb-3">
                    <h5>Contact Us</h5>
                    <div class="d-flex gap-2">
                        <i class="bi bi-telephone-fill"></i>
                        <a href="tel:<?= $pn1 ?>"
                            class="d-inline-block mb-2 text-decoration-none text-dark"><?= $pn1 ?></a>
                    </div>
                    <?php if ($pn2): ?>
                    <div class="d-flex gap-2">
                        <i class="bi bi-telephone-fill"></i>
                        <a href="tel:<?= $pn2 ?>"
                            class="d-inline-block mb-2 text-decoration-none text-dark"><?= $pn2 ?></a>
                    </div>
                    <?php endif; ?>
                    <div class="d-flex gap-2">
                        <i class="bi bi-geo-alt-fill"></i>
                        <span class="d-inline-block mb-2 text-decoration-none text-dark"><?= $address ?></span>
                    </div>
                    <div class="d-flex gap-2">
                        <i class="bi bi-envelope-fill"></i>
                        <a href="mailto:<?= $email ?>"
                            class="d-inline-block mb-2 text-decoration-none text-dark text-wrap"><?= $email ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require('inc/footer.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
    var swiper = new Swiper(".swiper-container", {
        spaceBetween: 30,
        effect: "fade",
        loop: true,
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
    });
    </script>
</body>

</html>