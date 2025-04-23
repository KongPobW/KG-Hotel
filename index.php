<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KG Hotel</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Merienda:wght@300..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white px-lg-3 py-lg-2 shadow-sm sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand me-5 fw-bold fs-3 h-font" href="index.php">KG HOTEL</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active me-2" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-2" href="#">Rooms</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-2" href="#">Facilities</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-2" href="#">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-2" href="#">About Us</a>
                    </li>
                </ul>
                <div class="d-flex">
                    <button type="button" class="btn btn-outline-dark shadow-none me-lg-3 me-2" data-bs-toggle="modal"
                        data-bs-target="#loginModal">
                        Login
                    </button>
                    <button type="button" class="btn btn-outline-dark shadow-none" data-bs-toggle="modal"
                        data-bs-target="#RegisterModal">
                        Register
                    </button>
                </div>
            </div>
        </div>
    </nav>
    <div class="modal fade my-3" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h5 class="modal-title d-flex align-items-center">
                            <i class="bi bi-person-circle me-2"></i>
                            User
                            Login
                        </h5>
                        <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <input type="email" class="form-control shadow-none">
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control shadow-none">
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <button type="submit" class="btn btn-dark shadow-none">LOGIN</button>
                            <a href="javascript: void(0)" class="text-secondary text-decoration-none">
                                Forgot
                                Password?
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade my-3" id="RegisterModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="RegisterModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h5 class="modal-title d-flex align-items-center">
                            <i class="bi bi-person-lines-fill me-2"></i>
                            User
                            Registration
                        </h5>
                        <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <span class="badge rounded-pill text-bg-light mb-3 text-wrap lh-base">
                            Note: Your details must
                            match with your ID (
                            ID card, passport, driving license, etc) that will be required during check-in.
                        </span>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-6 ps-0 mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control shadow-none">
                                </div>
                                <div class="col-md-6 p-0 mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control shadow-none">
                                </div>
                                <div class="col-md-6 ps-0 mb-3">
                                    <label class="form-label">Phone Number</label>
                                    <input type="text" class="form-control shadow-none">
                                </div>
                                <div class="col-md-6 p-0 mb-3">
                                    <label class="form-label">Picture</label>
                                    <input type="file" class="form-control shadow-none">
                                </div>
                                <div class="col-md-12 p-0 mb-3">
                                    <label class="form-label">Adress</label>
                                    <textarea class="form-control shadow-none" rows="1"></textarea>
                                </div>
                                <div class="col-md-6 ps-0 mb-3">
                                    <label class="form-label">Pin Code</label>
                                    <input type="text" class="form-control shadow-none">
                                </div>
                                <div class="col-md-6 p-0 mb-3">
                                    <label class="form-label">Date of Birth</label>
                                    <input type="date" class="form-control shadow-none">
                                </div>
                                <div class="col-md-6 ps-0 mb-3">
                                    <label class="form-label">Password</label>
                                    <input type="password" class="form-control shadow-none">
                                </div>
                                <div class="col-md-6 p-0 mb-3">
                                    <label class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control shadow-none">
                                </div>
                            </div>
                        </div>
                        <div class="text-center my-1">
                            <button type="submit" class="btn btn-dark shadow-none">REGISTER</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
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
            <div class="col-lg-4 col-md-6 my-3">
                <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
                    <img src="images/rooms/1.jpg" class="card-img-top">
                    <div class="card-body">
                        <h5>Simple Room Name</h5>
                        <h6 class="mb-4">฿6,120 per night</h6>
                        <div class="features mb-4">
                            <h6 class="mb-1">Features</h6>
                            <span class="badge rounded-pill text-bg-light text-wrap lh-base">1 Bedroom</span>
                            <span class="badge rounded-pill text-bg-light text-wrap lh-base">1 Bathroom</span>
                        </div>
                        <div class="facilities mb-4">
                            <h6 class="mb-1">Facilities</h6>
                            <span class="badge rounded-pill text-bg-light text-wrap lh-base">AC</span>
                            <span class="badge rounded-pill text-bg-light text-wrap lh-base">Wifi</span>
                            <span class="badge rounded-pill text-bg-light text-wrap lh-base">Water Heater</span>
                            <span class="badge rounded-pill text-bg-light text-wrap lh-base">Television</span>
                        </div>
                        <div class="rating mb-4">
                            <h6 class="mb-1">Rating</h6>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                        </div>
                        <div class="d-flex mb-2 gap-2">
                            <a href="#" class="btn btn-sm text-white custom-bg shadow-none">Book Now</a>
                            <a href="#" class="btn btn-sm btn-outline-dark shadow-none">Details</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 my-3">
                <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
                    <img src="images/rooms/1.jpg" class="card-img-top">
                    <div class="card-body">
                        <h5>Simple Room Name</h5>
                        <h6 class="mb-4">฿6,120 per night</h6>
                        <div class="features mb-4">
                            <h6 class="mb-1">Features</h6>
                            <span class="badge rounded-pill text-bg-light text-wrap lh-base">1 Bedroom</span>
                            <span class="badge rounded-pill text-bg-light text-wrap lh-base">1 Bathroom</span>
                        </div>
                        <div class="facilities mb-4">
                            <h6 class="mb-1">Facilities</h6>
                            <span class="badge rounded-pill text-bg-light text-wrap lh-base">AC</span>
                            <span class="badge rounded-pill text-bg-light text-wrap lh-base">Wifi</span>
                            <span class="badge rounded-pill text-bg-light text-wrap lh-base">Water Heater</span>
                            <span class="badge rounded-pill text-bg-light text-wrap lh-base">Television</span>
                        </div>
                        <div class="rating mb-4">
                            <h6 class="mb-1">Rating</h6>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                        </div>
                        <div class="d-flex mb-2 gap-2">
                            <a href="#" class="btn btn-sm text-white custom-bg shadow-none">Book Now</a>
                            <a href="#" class="btn btn-sm btn-outline-dark shadow-none">Details</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 my-3">
                <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
                    <img src="images/rooms/1.jpg" class="card-img-top">
                    <div class="card-body">
                        <h5>Simple Room Name</h5>
                        <h6 class="mb-4">฿6,120 per night</h6>
                        <div class="features mb-4">
                            <h6 class="mb-1">Features</h6>
                            <span class="badge rounded-pill text-bg-light text-wrap lh-base">1 Bedroom</span>
                            <span class="badge rounded-pill text-bg-light text-wrap lh-base">1 Bathroom</span>
                        </div>
                        <div class="facilities mb-4">
                            <h6 class="mb-1">Facilities</h6>
                            <span class="badge rounded-pill text-bg-light text-wrap lh-base">AC</span>
                            <span class="badge rounded-pill text-bg-light text-wrap lh-base">Wifi</span>
                            <span class="badge rounded-pill text-bg-light text-wrap lh-base">Water Heater</span>
                            <span class="badge rounded-pill text-bg-light text-wrap lh-base">Television</span>
                        </div>
                        <div class="rating mb-4">
                            <h6 class="mb-1">Rating</h6>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                        </div>
                        <div class="d-flex mb-2 gap-2">
                            <a href="#" class="btn btn-sm text-white custom-bg shadow-none">Book Now</a>
                            <a href="#" class="btn btn-sm btn-outline-dark shadow-none">Details</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 text-center mt-5">
                <a href="#" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">More Rooms ></a>
            </div>
        </div>
    </div>
    <!-- our facilities -->
    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">OUR FACILITIES</h2>
    <div class="container">
        <div class="row justify-content-between px-lg-0 px-md-0 px-5">
            <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
                <img src="images/facilities/wifi.svg" width="80px">
                <h5 class="mt-3">Wifi</h5>
            </div>
            <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
                <img src="images/facilities/ac.svg" width="80px">
                <h5 class="mt-3">Air Conditioner</h5>
            </div>
            <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
                <img src="images/facilities/tv.svg" width="80px">
                <h5 class="mt-3">Television</h5>
            </div>
            <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
                <img src="images/facilities/air-heater.svg" width="80px">
                <h5 class="mt-3">Air Heater</h5>
            </div>
            <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
                <img src="images/facilities/water-heater.svg" width="80px">
                <h5 class="mt-3">Water Heater</h5>
            </div>
            <div class="col-lg-12 text-center mt-5">
                <a href="#" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">More Facilities ></a>
            </div>
        </div>
    </div>
    <!-- reach us -->
    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">REACH US</h2>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8 p-4 mb-lg-0 mb-3 bg-white rounded">
                <iframe class="w-100 rounded"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d62008.63935942644!2d100.45646024863278!3d13.746279299999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e29ecd81421b2b%3A0xa1affc34a5f5632c!2z4Liq4Lii4Liy4Lih4LmA4LiL4LmH4LiZ4LmA4LiV4Lit4Lij4LmM!5e0!3m2!1sth!2sth!4v1745384321051!5m2!1sth!2sth"
                    height="320" loading="lazy"></iframe>
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="bg-white p-4 rounded mb-3">
                    <h5>Contact Us</h5>
                    <div class="d-flex gap-2">
                        <i class="bi bi-telephone-fill"></i>
                        <a href="tel:0982592063"
                            class="d-inline-block mb-2 text-decoration-none text-dark">0982592063</a>
                    </div>
                    <div class="d-flex gap-2">
                        <i class="bi bi-geo-alt-fill"></i>
                        <span class="d-inline-block mb-2 text-decoration-none text-dark">979 Rama I Rd., Pathumwan,
                            Pathumwan, Bangkok 10330</span>
                    </div>
                    <div class="d-flex gap-2">
                        <i class="bi bi-envelope-fill"></i>
                        <a href="mailto:kghotel@gmail.com"
                            class="d-inline-block mb-2 text-decoration-none text-dark text-wrap">kghotel@gmail.com</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- footer -->
    <footer class="container-fluid bg-black text-white mt-5 pt-5">
        <div class="row justify-content-between">
            <div class="col-12 col-md-6 col-lg-4 mb-4 px-4">
                <h3 class="h-font fw-bold fs-3 mb-3">KG HOTEL</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus aliquid beatae iure molestias ipsum
                    itaque, adipisci quas ad eum inventore assumenda dignissimos incidunt quos, ratione expedita facere?
                    Totam, accusantium pariatur.</p>
            </div>
            <div class="col-6 col-md-6 col-lg-2 mb-4 px-4">
                <h5 class="mb-3">Links</h5>
                <ul class="list-unstyled">
                    <li>
                        <a href="#" class="text-white text-decoration-none d-block mb-2">Home</a>
                    </li>
                    <li>
                        <a href="#" class="text-white text-decoration-none d-block mb-2">Rooms</a>
                    </li>
                    <li>
                        <a href="#" class="text-white text-decoration-none d-block mb-2">Facilities</a>
                    </li>
                    <li>
                        <a href="#" class="text-white text-decoration-none d-block mb-2">Contact Us</a>
                    </li>
                    <li>
                        <a href="#" class="text-white text-decoration-none d-block mb-2">About Us</a>
                    </li>
                </ul>
            </div>
            <div class="col-12 col-md-6 col-lg-4 mb-4 px-4">
                <h5 class="mb-3">Contact Us</h5>
                <div class="mb-2 d-flex align-items-center">
                    <i class="bi bi-telephone-fill me-2"></i>
                    <a href="tel:0982592063" class="text-white text-decoration-none">0982592063</a>
                </div>
                <div class="mb-2 d-flex align-items-center">
                    <i class="bi bi-geo-alt-fill me-2"></i>
                    <span>979 Rama I Rd., Pathumwan, Pathumwan, Bangkok 10330</span>
                </div>
                <div class="mb-2 d-flex align-items-center">
                    <i class="bi bi-envelope-fill me-2"></i>
                    <a href="mailto:kghotel@gmail.com" class="text-white text-decoration-none">kghotel@gmail.com</a>
                </div>
            </div>
        </div>
    </footer>
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