<footer class="container-fluid bg-black text-white mt-5 pt-5">
    <div class="row justify-content-between">
        <div class="col-12 col-md-6 col-lg-4 mb-4 px-4">
            <h3 class="h-font fw-bold fs-3 mb-3"><?= htmlspecialchars($site_title) ?></h3>
            <p><?= nl2br(htmlspecialchars($site_about)) ?></p>
        </div>

        <div class="col-6 col-md-6 col-lg-2 mb-4 px-4">
            <h5 class="mb-3">Links</h5>
            <ul class="list-unstyled">
                <li><a href="index.php" class="text-white text-decoration-none d-block mb-2">Home</a></li>
                <li><a href="rooms.php" class="text-white text-decoration-none d-block mb-2">Rooms</a></li>
                <li><a href="facilities.php" class="text-white text-decoration-none d-block mb-2">Facilities</a></li>
                <li><a href="contact.php" class="text-white text-decoration-none d-block mb-2">Contact Us</a></li>
                <li><a href="about.php" class="text-white text-decoration-none d-block mb-2">About Us</a></li>
            </ul>
        </div>

        <div class="col-12 col-md-6 col-lg-4 mb-4 px-4">
            <h5 class="mb-3">Contact Us</h5>
            <div class="mb-2 d-flex align-items-center">
                <i class="bi bi-telephone-fill me-2"></i>
                <a href="tel:<?= htmlspecialchars($pn1) ?>"
                    class="text-white text-decoration-none"><?= htmlspecialchars($pn1) ?></a>
            </div>
            <div class="mb-2 d-flex align-items-center">
                <i class="bi bi-geo-alt-fill me-2"></i>
                <span><?= htmlspecialchars($address) ?></span>
            </div>
            <div class="mb-2 d-flex align-items-center">
                <i class="bi bi-envelope-fill me-2"></i>
                <a href="mailto:<?= htmlspecialchars($email) ?>"
                    class="text-white text-decoration-none"><?= htmlspecialchars($email) ?></a>
            </div>
        </div>
    </div>
</footer>