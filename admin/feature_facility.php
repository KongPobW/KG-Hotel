<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Features & Facilities</title>
    <?php require('../public/link.php'); ?>
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

    .card-body-feature,
    .card-body-facility {
        z-index: 0 !important;
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
                <h3 class="mb-4">FEATURES & FACILITIES</h3>
                <div class="card border-0 shadow mb-3">
                    <div class="card-body card-body-feature">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0">Feature</h5>
                            <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal"
                                data-bs-target="#feature-adding">
                                <i class="bi bi-plus-square"></i> Add
                            </button>
                        </div>
                        <div class="table-responsive-md" style="height: 450px; overflow-y: scroll;">
                            <table class="table table-hover border">
                                <thead class="sticky-top">
                                    <tr style="background-color: black !important; color: white !important;">
                                        <th scope="col">#</th>
                                        <th scope="col" width="65%">Name</th>
                                        <th scope="col" width="10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="tbody-feature">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card border-0 shadow mb-3">
                    <div class="card-body card-body-facility">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0">Facility</h5>
                            <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal"
                                data-bs-target="#facility-adding">
                                <i class="bi bi-plus-square"></i> Add
                            </button>
                        </div>
                        <div class="table-responsive-md" style="height: 450px; overflow-y: scroll;">
                            <table class="table table-hover border">
                                <thead class="sticky-top">
                                    <tr style="background-color: black !important; color: white !important;">
                                        <th scope="col">#</th>
                                        <th scope="col">Icon</th>
                                        <th scope="col" width="20%">Name</th>
                                        <th scope="col" width="45%">Description</th>
                                        <th scope="col" width="10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="tbody-facility">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="feature-adding" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form>
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Feature</h5>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="feature_name" id="feature_name_input"
                                class="form-control shadow-none" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn text-secondary shadow-none" data-bs-dismiss="modal"
                                onclick="getFeatures()">CANCEL</button>
                            <button type="button" class="btn custom-bg text-white shadow-none"
                                onclick="addFeature(event)">SUBMIT</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="facility-adding" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="facility-form" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Facility</h5>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="facility_name" id="facility_name_input"
                                class="form-control shadow-none" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="facility_description" id="facility_description_input"
                                class="form-control shadow-none" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Icon</label>
                            <input type="file" name="facility_icon" id="facility_icon_input"
                                class="form-control shadow-none" accept="image/*" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn text-secondary shadow-none" data-bs-dismiss="modal"
                            onclick="getFacilities()">CANCEL</button>
                        <button type="submit" class="btn custom-bg text-white shadow-none"
                            onclick="addFacility(event)">SUBMIT</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <?php require('../public/script.php'); ?>

    <script src="../server/js/feature.js"></script>
    <script src="../server/js/facility.js"></script>
</body>

</html>