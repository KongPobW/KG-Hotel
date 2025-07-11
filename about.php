<?php 
require('public/db_config.php');
require('server/class/contact_detail.php');
require('server/class/setting.php');
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KG Hotel - About Us</title>
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
        <h2 class="fw-bold h-font text-center">ABOUT US</h2>
        <div class="h-line bg-dark"></div>
        <div class="row">
            <p class="text-center mt-3 w-75 mx-auto">
                <?= nl2br(htmlspecialchars($site_about)) ?>
            </p>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-lg-6 col-md-5 mb-4 order-2 order-lg-1 order-md-1">
                <h3 class="mb-3">James Clark</h3>
                <p>
                    Visionary CEO and founder of KG Hotel, James Clark brings years of international hospitality
                    experience and a passion for authentic Thai culture. Under his leadership, KG Hotel has grown into a
                    modern, guest-focused retreat that blends comfort with genuine Thai warmth. James is dedicated to
                    creating memorable stays by combining innovative service with heartfelt hospitality.
                </p>
            </div>
            <div class="col-lg-5 col-md-5 mb-4 order-1 order-lg-2 order-md-2">
                <img src="images/about/about.jpg" class="w-100">
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
                    <img src="images/about/hotel.svg" width="70px">
                    <h4 class="mt-3">100+ ROOMS</h4>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
                    <img src="images/about/customer.svg" width="70px">
                    <h4 class="mt-3">200+ CUSTOMERS</h4>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
                    <img src="images/about/rating.svg" width="70px">
                    <h4 class="mt-3">150+ REVIEWS</h4>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
                    <img src="images/about/staff.svg" width="70px">
                    <h4 class="mt-3">300+ STAFFS</h4>
                </div>
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