<?php
    session_start();

    require('../inc/db_config.php');
    require('../inc/utils.php');

    if (isset($_SESSION['isAdminLogin']) && $_SESSION['isAdminLogin'] == true) {
        redirect('dashboard.php');
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <?php require('../inc/link.php'); ?>
    <link rel="stylesheet" href="./css/common.css">
    <style>
    .custom-alert {
        position: fixed;
        top: 25px;
        right: 25px;
    }
    </style>
</head>

<body class="bg-light">
    <div class="login-form text-center rounded bg-white shadow overflow-hidden">
        <form method="POST">
            <h4 class="text-center bg-dark text-white py-3">ADMIN LOGIN</h4>
            <div class="p-4">
                <div class="mb-3">
                    <input name="admin_name" type="text" class="form-control shadow-none text-center" required
                        placeholder="Username">
                </div>
                <div class="mb-4">
                    <input name="admin_pass" type="password" class="form-control shadow-none text-center" required
                        placeholder="Password">
                </div>
                <button name="login" type="submit" class="btn text-white custom-bg shadow-none">LOGIN</button>
            </div>
        </form>
    </div>

    <?php
    if (isset($_POST['login'])) {
        $admin_name = $_POST['admin_name'];
        $admin_pass = $_POST['admin_pass'];

        $stmt = $conn->prepare("SELECT * FROM admin_cred WHERE admin_name = ? AND admin_pass = ?");
        $stmt->execute([$admin_name, $admin_pass]);

        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            $_SESSION['admin_id'] = $user['sr_no'];
            $_SESSION['isAdminLogin'] = true;

            redirect('dashboard.php');
        } else {
            alert('danger', 'Incorrect Username or Password');
        }
    }
    ?>

    <?php require('inc/script.php'); ?>
</body>

</html>