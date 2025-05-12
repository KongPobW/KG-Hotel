<?php
require('../public/db_config.php');

if (isset($_POST['get_facilities'])) {
    $stmt = $conn->prepare("SELECT * FROM facilities");
    $stmt->execute();
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
    exit;
}

if (isset($_POST['add_facility'])) {
    $name = trim($_POST['name'] ?? '');
    $desc = trim($_POST['description'] ?? '');

    if ($name === '' || $desc === '' || !isset($_FILES['icon'])) {
        echo '0';
        exit;
    }

    $img = $_FILES['icon'];
    $img_name = time() . '_' . basename($img['name']);
    $img_path = 'uploads/facilities/' . $img_name;
    $img_ext = strtolower(pathinfo($img_name, PATHINFO_EXTENSION));
    
    $allowed_ext = ['jpg', 'jpeg', 'png', 'webp', 'svg'];

    if (!in_array($img_ext, $allowed_ext)) {
        echo 'invalid_image';
        exit;
    }

    $allowed_mimes = ['image/jpeg', 'image/png', 'image/webp', 'image/svg+xml'];
    if (!in_array($img['type'], $allowed_mimes)) {
        echo 'invalid_mime';
        exit;
    }

    if (move_uploaded_file($img['tmp_name'], $img_path)) {
        $stmt = $conn->prepare("INSERT INTO facilities (name, description, icon) VALUES (?, ?, ?)");
        $res = $stmt->execute([$name, $desc, $img_name]);

        echo $res ? '1' : '0';
    } else {
        echo 'upload_failed';
    }
    exit;
}

if (isset($_POST['delete_facility'])) {
    $id = $_POST['id'] ?? '';

    $stmt = $conn->prepare("SELECT icon FROM facilities WHERE id = ?");
    $stmt->execute([$id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        $iconPath = 'uploads/facilities/' . $row['icon'];

        $stmt = $conn->prepare("DELETE FROM facilities WHERE id = ?");
        $res = $stmt->execute([$id]);

        if ($res) {
            if (file_exists($iconPath)) {
                unlink($iconPath);
            }
            echo '1';
        } else {
            echo '0';
        }
    } else {
        echo '0';
    }
    exit;
}
?>