<?php
require 'inc/db_config.php';

class Contact {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getContactInfo() {
        $query = "SELECT * FROM contact_details WHERE sr_no = 1";
        $stmt = $this->conn->prepare($query);

        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

$database = new Database();
$db = $database->getConnection();

$contact = new Contact($db);

$contact_info = $contact->getContactInfo();

$address = $contact_info['address'];
$pn1 = $contact_info['pn1'];
$pn2 = $contact_info['pn2'];
$email = $contact_info['email'];
$gmap = $contact_info['gmap'];
?>

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
                    <iframe class="w-100 rounded mb-4" src="<?php echo htmlspecialchars($gmap); ?>" height="320"
                        loading="lazy"></iframe>
                    <h5>Address</h5>
                    <div class="d-flex gap-2">
                        <i class="bi bi-geo-alt-fill"></i>
                        <span
                            class="d-inline-block mb-2 text-decoration-none text-dark"><?php echo htmlspecialchars($address); ?></span>
                    </div>
                    <h5 class="mt-3">Call Us</h5>
                    <div class="col gap-2">
                        <div class="d-flex gap-2">
                            <i class="bi bi-telephone-fill"></i>
                            <a href="tel:<?php echo htmlspecialchars($pn1); ?>"
                                class="d-inline-block mb-2 text-decoration-none text-dark"><?php echo htmlspecialchars($pn1); ?></a>
                        </div>
                        <div class="d-flex gap-2">
                            <i class="bi bi-telephone-fill"></i>
                            <a href="tel:<?php echo htmlspecialchars($pn2); ?>"
                                class="d-inline-block mb-2 text-decoration-none text-dark"><?php echo htmlspecialchars($pn2); ?></a>
                        </div>
                    </div>
                    <h5 class="mt-3">Email</h5>
                    <div class="d-flex gap-2">
                        <i class="bi bi-envelope-fill"></i>
                        <a href="mailto:<?php echo htmlspecialchars($email); ?>"
                            class="d-inline-block mb-2 text-decoration-none text-dark text-wrap"><?php echo htmlspecialchars($email); ?></a>
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