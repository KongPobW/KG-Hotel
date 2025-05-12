<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Dashboard</title>
    <?php require('../public/link.php'); ?>
    <link rel="stylesheet" href="./css/style.css">
    <style>
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
        <dic class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">

            </div>
        </dic>
    </div>

    <?php require('public/script.php'); ?>
</body>

</html>