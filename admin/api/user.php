<?php
require('../inc/db_config.php');
require('../../inc/utils.php');

if (isset($_POST['register_user'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $pnumber = trim($_POST['pnumber']);
    $address = trim($_POST['address']);
    $pincode = trim($_POST['pincode']);
    $dob = $_POST['dob'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $profile = $_FILES['profile'];
    $ext = pathinfo($profile['name'], PATHINFO_EXTENSION);
    $allowed = ['jpg', 'jpeg', 'png', 'webp', 'svg'];

    if (!in_array(strtolower($ext), $allowed)) {
        echo 'invalid_img';
        exit;
    }

    $img_name = uniqid("IMG_", true) . "." . $ext;
    $img_path = "../uploads/profiles/" . $img_name;

    if (!move_uploaded_file($profile['tmp_name'], $img_path)) {
        echo 'img_upload_failed';
        exit;
    }

    $query = $conn->prepare("INSERT INTO user_cred (name, email, address, pnumber, pincode, dob, profile, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $res = $query->execute([$name, $email, $address, $pnumber, $pincode, $dob, $img_name, $password]);

    echo $res ? 1 : 0;
}

if (isset($_POST['reset_password'])) {
    $email = trim($_POST['email']);
    $pinCode = trim($_POST['pinCode']);
    $newPassword = $_POST['newPassword'];

    $emailQuery = $conn->prepare("SELECT * FROM user_cred WHERE email = ?");
    $emailQuery->execute([$email]);
    $user = $emailQuery->fetch();

    if (!$user) {
        echo 'invalid_email';
        exit;
    }

    $storedPin = trim($user['pincode']);

    if (strcasecmp($storedPin, $pinCode) !== 0) {
        echo 'invalid_pin';
        exit;
    }

    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
    $updateQuery = $conn->prepare("UPDATE user_cred SET password = ? WHERE email = ?");
    $res = $updateQuery->execute([$hashedPassword, $email]);

    echo $res ? '1' : '0';
}
?>