<?php
require('admin/inc/db_config.php');
require('admin/class/facility.php');
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KG Hotel - Facilities</title>
    <?php require('inc/link.php'); ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php require('inc/header.php'); ?>
    <?php require('inc/modal.php'); ?>

    <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center">OUR FACILITIES</h2>
        <div class="h-line bg-dark"></div>
        <div class="row">
            <p class="text-center mt-3 w-75 mx-auto">
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Officiis sequi
                facilis consequuntur voluptatum exercitationem, obcaecati possimus labore iste qui delectus sit omnis
                dolorum ut
                cumque reiciendis vitae quibusdam officia. Repellendus.
            </p>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <?php foreach ($facilities as $row): ?>
            <div class="col-lg-4 col-md-6 mb-5 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 border-dark pop">
                    <div class="d-flex align-items-center mb-2">
                        <img src="admin/uploads/facilities/<?php echo htmlspecialchars($row['icon']); ?>" width="40px"
                            alt="icon">
                        <h5 class="m-0 ms-3"><?php echo htmlspecialchars($row['name']); ?></h5>
                    </div>
                    <p><?php echo htmlspecialchars($row['description']); ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <?php require('inc/footer.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous">
    </script>
</body>

</html>