<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Setting</title>
    <?php require('inc/link.php'); ?>
    <link rel="stylesheet" href="./css/common.css">
    <style>
    .custom-alert {
        position: fixed;
        top: 80px;
        right: 25px;
    }
    </style>
</head>

<body class="bg-light">
    <?php require('inc/header.php'); ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-4">SETTING</h3>

                <!-- General Setting Section -->
                <div class="card border-0 shadow mb-3">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0">General Setting</h5>
                            <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal"
                                data-bs-target="#general-setting">
                                <i class="bi bi-pencil-fill"></i> Edit
                            </button>
                        </div>
                        <h6 class="card-subtitle mb-1 fw-bold">Site Title</h6>
                        <p class="card-text" id="general_site_title">Loading...</p>
                        <h6 class="card-subtitle mb-1 fw-bold">About Us</h6>
                        <p class="card-text" id="general_site_about">Loading...</p>
                    </div>
                </div>

                <!-- General Setting Modal -->
                <div class="modal fade" id="general-setting" data-bs-backdrop="static" data-bs-keyboard="true"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form>
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">General Setting</h5>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label">Site Title</label>
                                        <input type="text" name="site_title" id="site_title_input"
                                            class="form-control shadow-none" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">About Us</label>
                                        <textarea class="form-control shadow-none" name="site_about"
                                            id="site_about_input" rows="5" required></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn text-secondary shadow-none" data-bs-dismiss="modal"
                                        onclick="getGeneralSetting()">CANCEL</button>
                                    <button type="submit" class="btn custom-bg text-white shadow-none"
                                        onclick="updateGeneralSetting()">SUBMIT</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Shutdown Section -->
                <div class="card border-0 shadow mb-3">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0">Shutdown Website</h5>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="shutdown-toggle">
                            </div>
                        </div>
                        <p class="card-text">No customers will be allowed to book hotel rooms when shutdown mode is
                            turned on.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require('inc/script.php'); ?>

    <script src="mdb/general_setting.js"></script>
</body>

</html>