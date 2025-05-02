<?php
require('inc/db_config.php');
require('class/feature.php');
require('class/facility.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Rooms</title>
    <?php require('../inc/link.php'); ?>
    <link rel="stylesheet" href="./css/style.css">
    <style>
    .custom-alert {
        position: fixed;
        top: 80px;
        right: 25px;
    }

    #admin-menu {
        position: fixed;
        height: 100%;
        z-index: 2;
    }

    @media screen and (max-width: 992px) {
        #admin-menu {
            height: auto;
            width: 100%;
        }
    }
    </style>
</head>

<body class="bg-light">
    <?php require('inc/header.php'); ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-4">ROOMS</h3>
                <div class="card border-0 shadow mb-3">
                    <div class="card-body">
                        <div class="text-end mb-3">
                            <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal"
                                data-bs-target="#room-adding">
                                <i class="bi bi-plus-square"></i> Add
                            </button>
                        </div>
                        <div class="table-responsive-lg" style="height: 450px; overflow-y: scroll;">
                            <table class="table table-hover border">
                                <thead class="sticky-top">
                                    <tr style="background-color: black !important; color: white !important;">
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col" width="10%">Area</th>
                                        <th scope="col" width="15%">Guests</th>
                                        <th scope="col" width="5%">Price(฿)</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Features</th>
                                        <th scope="col">Facilities</th>
                                        <th scope="col" width="5%">Status</th>
                                        <th scope="col" width="15%">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="tbody-room">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="room-adding" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form>
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Room</h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" id="room_name_input_add" class="form-control shadow-none"
                                    required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Area (sqft)</label>
                                <input type="text" name="area" id="area_input_add" class="form-control shadow-none"
                                    required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Price (฿)</label>
                                <input type="text" name="price" id="price_input_add" class="form-control shadow-none"
                                    required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Quantity</label>
                                <input type="text" name="quantity" id="quantity_input_add"
                                    class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Adult (Max.)</label>
                                <input type="text" name="adult" id="adult_max_input_add"
                                    class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Children (Max.)</label>
                                <input type="text" name="children" id="children_max_input"
                                    class="form-control shadow-none" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label fw-bold">Feature</label>
                                <div class="row">
                                    <?php
                                    foreach ($features as $feature) {
                                        echo '
                                        <div class="col-md-3 mb-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="features[]_add" value="' . htmlspecialchars($feature['id']) . '" id="feature_add_' . $feature['id'] . '">
                                                <label class="form-check-label" for="feature_add' . $feature['id'] . '">
                                                    ' . htmlspecialchars($feature['name']) . '
                                                </label>
                                            </div>
                                        </div>';
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label fw-bold">Facility</label>
                                <div class="row">
                                    <?php
                                    foreach ($facilities as $facility) {
                                        echo '
                                        <div class="col-md-3 mb-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="facilities[]_add" value="' . htmlspecialchars($facility['id']) . '" id="facility_add' . $facility['id'] . '">
                                                <label class="form-check-label" for="facility_add' . $facility['id'] . '">
                                                    ' . htmlspecialchars($facility['name']) . '
                                                </label>
                                            </div>
                                        </div>';
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label">Description</label>
                                <textarea name="desc" rows="3" class="form-control shadow-none"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn text-secondary shadow-none" data-bs-dismiss="modal"
                                onclick="getRooms()">CANCEL</button>
                            <button type="button" class="btn custom-bg text-white shadow-none"
                                onclick="addRoom(event)">SUBMIT</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="room-editing" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form>
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Room</h5>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="room_id_input">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" id="room_name_input_edit"
                                    class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Area (sqft)</label>
                                <input type="text" name="area" id="area_input_edit" class="form-control shadow-none"
                                    required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Price (฿)</label>
                                <input type="text" name="price" id="price_input_edit" class="form-control shadow-none"
                                    required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Quantity</label>
                                <input type="text" name="quantity" id="quantity_input_edit"
                                    class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Adult (Max.)</label>
                                <input type="text" name="adult" id="adult_max_input_edit"
                                    class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Children (Max.)</label>
                                <input type="text" name="children" id="children_max_input_edit"
                                    class="form-control shadow-none" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label fw-bold">Feature</label>
                                <div class="row">
                                    <?php
                                    foreach ($features as $feature) {
                                        echo '
                                        <div class="col-md-3 mb-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="features[]_edit" value="' . htmlspecialchars($feature['id']) . '" id="feature_edit' . $feature['id'] . '">
                                                <label class="form-check-label" for="feature_edit' . $feature['id'] . '">
                                                    ' . htmlspecialchars($feature['name']) . '
                                                </label>
                                            </div>
                                        </div>';
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label fw-bold">Facility</label>
                                <div class="row">
                                    <?php
                                    foreach ($facilities as $facility) {
                                        echo '
                                        <div class="col-md-3 mb-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="facilities[]_edit" value="' . htmlspecialchars($facility['id']) . '" id="facility_edit' . $facility['id'] . '">
                                                <label class="form-check-label" for="facility_edit' . $facility['id'] . '">
                                                    ' . htmlspecialchars($facility['name']) . '
                                                </label>
                                            </div>
                                        </div>';
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label">Description</label>
                                <textarea name="desc" rows="3" class="form-control shadow-none"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn text-secondary shadow-none" data-bs-dismiss="modal"
                                onclick="getRooms()">CANCEL</button>
                            <button type="button" class="btn custom-bg text-white shadow-none"
                                onclick="updateRoom(event)">SUBMIT</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="room-image" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form>
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Room Image</h5>
                    </div>
                    <div class="modal-body">
                        <label class="form-label">Select Room Cover</label>
                        <input type="file" name="room_cover" id="room_cover_input" class="form-control shadow-none mb-3"
                            accept="image/*">
                        <label class="form-label">Select Room Image(s)</label>
                        <input type="file" name="room_images[]" id="room_image_input"
                            class="form-control shadow-none mb-3" accept="image/*" multiple>

                        <table class="table table-bordered mt-3">
                            <thead>
                                <tr>
                                    <th>Cover</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="imagePreviewTable">
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn text-secondary shadow-none" data-bs-dismiss="modal"
                            onclick="getRooms()">CANCEL</button>
                        <button type="button" class="btn custom-bg text-white shadow-none"
                            onclick="uploadImageAndCover(event)">UPLOAD</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <?php require('inc/script.php'); ?>

    <script src="server/room.js"></script>
</body>

</html>