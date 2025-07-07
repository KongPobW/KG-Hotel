<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Payment Proof</title>
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
        z-index: 1;
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
                <h3 class="mb-4">PAYMENT PROOF</h3>
                <div class="card border-0 shadow mb-3">
                    <div class="card-body">
                        <div class="table-responsive-md" style="height: 450px; overflow-y: scroll;">
                            <table class="table table-hover border">
                                <thead class="sticky-top">
                                    <tr style="background-color: black !important; color: white !important;">
                                        <td style="display: none;">Payment ID</td>
                                        <th scope="col">#</th>
                                        <th scope="col">Booker Name</th>
                                        <th scope="col">Phone Number</th>
                                        <th scope="col">Booking Date</th>
                                        <th scope="col">Subtotal</th>
                                        <th scope="col">Arrival Slip</th>
                                        <th scope="col">Refund Slip</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require('../public/script.php'); ?>

    <script src="../server/js/payment_proof.js"></script>
</body>

</html>