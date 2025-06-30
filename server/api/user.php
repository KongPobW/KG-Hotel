<?php
require(__DIR__ . '/../../public/db_config.php');

if (isset($_POST['get_users'])) {
    $query = $conn->query("SELECT * FROM user_cred ORDER BY sr_no DESC");
    $users = $query->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($users);
}

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

    $uploadDir = __DIR__ . '/../../uploads/profiles/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $img_name = uniqid("IMG_", true) . "." . $ext;
    $img_path = $uploadDir . $img_name;

    if (!move_uploaded_file($profile['tmp_name'], $img_path)) {
        echo 'img_upload_failed';
        exit;
    }

    $relative_img_path = $img_name;

    $query = $conn->prepare("INSERT INTO user_cred (name, email, address, pnumber, pincode, dob, profile, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $res = $query->execute([$name, $email, $address, $pnumber, $pincode, $dob, $relative_img_path, $password]);

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

if (isset($_POST['login_user'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM user_cred WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        echo 'invalid_email';
        exit;
    }

    if (!password_verify($password, $user['password'])) {
        echo 'invalid_password';
        exit;
    }

    if (isset($user['status']) && intval($user['status']) === 0) {
        echo 'inactive_user';
        exit;
    }

    session_start();
    $_SESSION['user_id'] = $user['sr_no'];
    $_SESSION['user_name'] = $user['name'];
    $_SESSION['profile'] = $user['profile'];

    echo '1';
}

if (isset($_POST['update_status'])) {
    $userId = intval($_POST['user_id']);
    $status = intval($_POST['status']) === 1 ? 1 : 0;

    $stmt = $conn->prepare("UPDATE user_cred SET status = ? WHERE sr_no = ?");
    $res = $stmt->execute([$status, $userId]);

    echo $res ? '1' : '0';
}
?>