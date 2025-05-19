<?php
require(__DIR__ . '/../../public/db_config.php');

if (isset($_POST['get_general'])) {
    $stmt = $conn->prepare("SELECT * FROM setting WHERE sr_no = 1");
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $setting = $stmt->fetch(PDO::FETCH_ASSOC);
        echo json_encode($setting);
    } else {
        echo json_encode(['error' => 'No general setting found']);
    }
}

if (isset($_POST['update_general'])) {
    $site_title = $_POST['site_title'] ?? '';
    $site_about = $_POST['site_about'] ?? '';

    $stmt = $conn->prepare("UPDATE setting SET site_title = ?, site_about = ? WHERE sr_no = 1");
    $result = $stmt->execute([$site_title, $site_about]);

    echo $result ? '1' : '0';
}

if (isset($_GET['get_shutdown'])) {
    $query = $conn->query("SELECT shutdown FROM setting WHERE sr_no = 1");
    $row = $query->fetch(PDO::FETCH_ASSOC);

    echo $row['shutdown'];
}

if (isset($_POST['update_shutdown'])) {
    $shutdown_mode = $_POST['shutdown_mode'] == '1' ? 1 : 0;

    $stmt = $conn->prepare("UPDATE setting SET shutdown = ? WHERE sr_no = 1");
    $result = $stmt->execute([$shutdown_mode]);

    echo $result ? '1' : '0';
}

if (isset($_POST['get_contact'])) {
    $stmt = $conn->prepare("SELECT * FROM contact_details WHERE sr_no = 1");
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $contact = $stmt->fetch(PDO::FETCH_ASSOC);
        echo json_encode($contact);
    } else {
        echo json_encode(['error' => 'No contact details found']);
    }
}

if (isset($_POST['update_contact'])) {
    $gmap = $_POST['gmap'] ?? '';
    $address = $_POST['address'] ?? '';
    $pn1 = $_POST['pn1'] ?? '';
    $pn2 = $_POST['pn2'] ?? '';
    $email = $_POST['email'] ?? '';

    $stmt = $conn->prepare("UPDATE contact_details SET gmap = ?, address = ?, pn1 = ?, pn2 = ?, email = ? WHERE sr_no = 1");
    $result = $stmt->execute([$gmap, $address, $pn1, $pn2, $email]);

    echo $result ? '1' : '0';
}
?>