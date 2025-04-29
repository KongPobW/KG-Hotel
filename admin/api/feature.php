<?php
require('../inc/db_config.php');
require('../../inc/utils.php');

if (isset($_POST['add_feature'])) {
    $name = trim($_POST['name']);
    $query = $conn->prepare("INSERT INTO features (name) VALUES (?)");
    $res = $query->execute([$name]);
    echo $res ? 1 : 0;
}

if (isset($_POST['get_features'])) {
    $query = $conn->query("SELECT * FROM features ORDER BY id DESC");
    echo json_encode($query->fetchAll(PDO::FETCH_ASSOC));
}

if (isset($_POST['delete_feature'])) {
    $id = $_POST['id'];
    $query = $conn->prepare("DELETE FROM features WHERE id = ?");
    $res = $query->execute([$id]);
    echo $res ? 1 : 0;
}
?>