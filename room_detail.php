<?php
require('admin/inc/db_config.php');
require('admin/class/room.php');
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KG Hotel - Room Detail</title>
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
    <?php require('inc/utils.php'); ?>
    <?php require('inc/modal.php'); ?>

    <?php
    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
        redirect('rooms.php');
    }
    
    $room_id = $_GET['id'];
    $roomObj = new Room($db);
    $room = $roomObj->getRoomById($room_id);
    ?>

    <div class="container">
        <div class="row">
            <div class="col-12 my-5 mb-4 px-4">
                <h2 class="fw-bold"><?php echo $room['name']; ?></h2>
                <div style="font-size: 15px;">
                    <a href="index.php" class="text-secondary text-decoration-none">HOME</a>
                    <span class="text-secondary"> > </span>
                    <a href="rooms.php" class="text-secondary text-decoration-none">ROOMS</a>
                </div>
            </div>

            <div class="col-lg-7 col-md-12 px-4">
                <div id="roomCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <?php 
                    $roomImages = $roomObj->getRoomImagesById($room_id);
                    if (!empty($roomImages)) {
                        $active = true;
                        foreach ($roomImages as $img) {
                            $imagePath = 'admin/uploads/rooms/images/' . htmlspecialchars($img['image']);
                            echo '<div class="carousel-item' . ($active ? ' active' : '') . '">';
                            echo '<img src="' . $imagePath . '" class="d-block w-100 rounded">';
                            echo '</div>';
                            $active = false;
                        }
                    }
                    ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#roomCarousel"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#roomCarousel"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>

            <div class="col-lg-5 col-md-12 px-4">
                <div class="card mb-4 border-0 shadow-sm rounded-3">
                    <div class="card-body">
                        <h4 class="mb-3">฿<?php echo number_format($room['price'], 0); ?> per night</h4>
                        <div class="mb-3">
                            <h6 class="mb-2">Features</h6>
                            <?php 
                            $features = explode(',', $room['features']);
                            foreach ($features as $feature):
                            ?>
                            <span
                                class="badge rounded-pill text-bg-light text-wrap lh-base mt-2"><?php echo $feature; ?></span>
                            <?php endforeach; ?>
                        </div>
                        <div class="mb-3">
                            <h6 class="mb-2">Facilities</h6>
                            <?php 
                            $facilities = explode(',', $room['facilities']);
                            foreach ($facilities as $facility):
                            ?>
                            <span
                                class="badge rounded-pill text-bg-light text-wrap lh-base mt-2"><?php echo $facility; ?></span>
                            <?php endforeach; ?>
                        </div>
                        <div class="mb-3">
                            <h6 class="mb-2">Area</h6>
                            <span
                                class="badge rounded-pill text-bg-light text-wrap lh-base mt-2"><?php echo $room['area']; ?>
                                sqft</span>
                        </div>
                        <div class="mb-3">
                            <h6 class="mb-2">Guests</h6>
                            <span
                                class="badge rounded-pill text-bg-light text-wrap lh-base mt-2"><?php echo $room['adult']; ?>
                                Adults</span>
                            <span
                                class="badge rounded-pill text-bg-light text-wrap lh-base mt-2"><?php echo $room['children']; ?>
                                Children</span>
                        </div>
                        <a href="#" class="btn btn-sm w-100 text-white custom-bg shadow-none mb-3">Book Now</a>
                    </div>
                </div>
            </div>

            <div class="col-12 mt-4 px-4">
                <div class="mb-4">
                    <h5>Description</h5>
                    <p><?php echo $room['description']; ?></p>
                </div>
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