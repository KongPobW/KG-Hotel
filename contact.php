<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KG Hotel - Contact Us</title>
    <?php require('inc/link.php'); ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
</head>

<body>
    <?php require('inc/header.php'); ?>
    <?php require('inc/modal.php'); ?>

    <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center">CONTACT US</h2>
        <div class="h-line bg-dark"></div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 mb-5 px-4">
                <div class="bg-white rounded shadow p-4">
                    <iframe class="w-100 rounded mb-4"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d62008.63935942644!2d100.45646024863278!3d13.746279299999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e29ecd81421b2b%3A0xa1affc34a5f5632c!2z4Liq4Lii4Liy4Lih4LmA4LiL4LmH4LiZ4LmA4LiV4Lit4Lij4LmM!5e0!3m2!1sth!2sth!4v1745384321051!5m2!1sth!2sth"
                        height="320" loading="lazy"></iframe>
                    <h5>Address</h5>
                    <div class="d-flex gap-2">
                        <i class="bi bi-geo-alt-fill"></i>
                        <a href="https://maps.app.goo.gl/TiLVzfpf22P7JFmS9" target="_blank"
                            class="d-inline-block mb-2 text-decoration-none text-dark">979 Rama I Rd., Pathumwan,
                            Pathumwan, Bangkok 10330</a>
                    </div>
                    <h5 class="mt-3">Call Us</h5>
                    <div class="col gap-2">
                        <div class="d-flex gap-2">
                            <i class="bi bi-telephone-fill"></i>
                            <a href="tel:0982592063"
                                class="d-inline-block mb-2 text-decoration-none text-dark">0982592063</a>
                        </div>
                        <div class="d-flex gap-2">
                            <i class="bi bi-telephone-fill"></i>
                            <a href="tel:0927684756"
                                class="d-inline-block mb-2 text-decoration-none text-dark">0927684756</a>
                        </div>
                    </div>
                    <h5 class="mt-3">Email</h5>
                    <div class="d-flex gap-2">
                        <i class="bi bi-envelope-fill"></i>
                        <a href="mailto:kghotel@gmail.com"
                            class="d-inline-block mb-2 text-decoration-none text-dark text-wrap">kghotel@gmail.com</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 mb-5 px-4">
                <div class="bg-white rounded shadow p-4">
                    <form action="">
                        <h5 class="fw-bold">Send Message</h5>
                        <div class="mt-3">
                            <label class="form-label" style="font-weight: 500;">Name</label>
                            <input type="text" class="form-control shadow-none">
                        </div>
                        <div class="mt-3">
                            <label class="form-label" style="font-weight: 500;">Email</label>
                            <input type="email" class="form-control shadow-none">
                        </div>
                        <div class="mt-3">
                            <label class="form-label" style="font-weight: 500;">Subject</label>
                            <input type="text" class="form-control shadow-none">
                        </div>
                        <div class="mt-3">
                            <label class="form-label" style="font-weight: 500;">Message</label>
                            <textarea class="form-control shadow-none" rows="5" style="resize: none;"></textarea>
                        </div>
                        <button type="submit" class="btn text-white custom-bg mt-3">SUBMIT</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php require('inc/footer.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous">
    </script>
</body>

</html>