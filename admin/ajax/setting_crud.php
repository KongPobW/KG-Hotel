<?php
require('../inc/db_config.php');
require('../inc/utils.php');

if (isset($_POST['get_general'])) {
    $stmt = $conn->prepare("SELECT * FROM setting WHERE sr_no = 1");
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $setting = $stmt->fetch(PDO::FETCH_ASSOC);
        echo json_encode($setting);
    } else {
        echo json_encode(['error' => 'No setting found']);
    }
}

if (isset($_POST['update_general'])) {
    $site_title = $_POST['site_title'] ?? '';
    $site_about = $_POST['site_about'] ?? '';

    $stmt = $conn->prepare("UPDATE setting SET site_title = ?, site_about = ? WHERE sr_no = 1");
    $result = $stmt->execute([$site_title, $site_about]);

    echo $result ? '1' : '0';
}

if (isset($_POST['update_shutdown'])) {
    $shutdown_mode = $_POST['shutdown_mode'] == '1' ? 1 : 0;

    $stmt = $conn->prepare("UPDATE setting SET shutdown = ? WHERE sr_no = 1");
    $result = $stmt->execute([$shutdown_mode]);

    echo $result ? '1' : '0';
}
?>