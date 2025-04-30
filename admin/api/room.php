<?php
require('../inc/db_config.php');
require('../../inc/utils.php');

if (isset($_POST['add_room'])) {
    try {
        $name = $_POST['name'];
        $area = $_POST['area'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];
        $adult = $_POST['adult'];
        $children = $_POST['children'];
        $desc = $_POST['desc'];

        $query = $conn->prepare("INSERT INTO room (name, area, price, quant, adult, children, description)
                                 VALUES (?,?,?,?,?,?,?)");
        $res = $query->execute([
            $name, $area, $price, $quantity, $adult, $children, $desc
        ]);

        if ($res) {
            $room_id = $conn->lastInsertId();

            if (isset($_POST['features'])) {
                foreach ($_POST['features'] as $feature_id) {
                    $conn->prepare("INSERT INTO room_features (id_room, id_features) VALUES (?, ?)")
                         ->execute([$room_id, $feature_id]);
                }
            }

            if (isset($_POST['facilities'])) {
                foreach ($_POST['facilities'] as $facility_id) {
                    $conn->prepare("INSERT INTO room_facilities (id_room, id_facilities) VALUES (?, ?)")
                         ->execute([$room_id, $facility_id]);
                }
            }

            echo 1;
        } else {
            echo 0;
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

if (isset($_POST['get_rooms'])) {
    $query = $conn->query("SELECT * FROM room");
    $rooms = $query->fetchAll(PDO::FETCH_ASSOC);

    foreach ($rooms as &$room) {
        $feature_stmt = $conn->prepare("SELECT f.name FROM features f
            INNER JOIN room_features rf ON f.id = rf.id_features
            WHERE rf.id_room = ?");
        $feature_stmt->execute([$room['id']]);
        $room['features'] = $feature_stmt->fetchAll(PDO::FETCH_COLUMN);

        $facility_stmt = $conn->prepare("SELECT f.name FROM facilities f
            INNER JOIN room_facilities rf ON f.id = rf.id_facilities
            WHERE rf.id_room = ?");
        $facility_stmt->execute([$room['id']]);
        $room['facilities'] = $facility_stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    echo json_encode($rooms);
}

if (isset($_POST['delete_room'])) {
    $id = $_POST['id'];

    $conn->prepare("DELETE FROM room_features WHERE id_room = ?")->execute([$id]);
    $conn->prepare("DELETE FROM room_facilities WHERE id_room = ?")->execute([$id]);
    $res = $conn->prepare("DELETE FROM room WHERE id = ?")->execute([$id]);

    echo $res ? 1 : 0;
}

if (isset($_POST['toggle_status'])) {
    $id = $_POST['id'];
    $status = $_POST['status'];
    
    $stmt = $conn->prepare("UPDATE room SET status = ? WHERE id = ?");
    $res = $stmt->execute([$status, $id]);
    
    echo $res ? 1 : 0;
}

if (isset($_POST['get_room_by_id'])) {
    $id = $_POST['id'];

    $query = $conn->prepare("SELECT * FROM room WHERE id = ?");
    $query->execute([$id]);
    $room = $query->fetch(PDO::FETCH_ASSOC);

    $features_stmt = $conn->prepare("SELECT id_features FROM room_features WHERE id_room = ?");
    $features_stmt->execute([$id]);
    $features = $features_stmt->fetchAll(PDO::FETCH_COLUMN);

    $facilities_stmt = $conn->prepare("SELECT id_facilities FROM room_facilities WHERE id_room = ?");
    $facilities_stmt->execute([$id]);
    $facilities = $facilities_stmt->fetchAll(PDO::FETCH_COLUMN);

    echo json_encode([
        'room' => $room,
        'features' => $features,
        'facilities' => $facilities
    ]);
}

if (isset($_POST['update_room'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $area = $_POST['area'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $adult = $_POST['adult'];
    $children = $_POST['children'];
    $desc = $_POST['desc'];

    $update_query = $conn->prepare("UPDATE room SET name=?, area=?, price=?, quant=?, adult=?, children=?, description=? WHERE id=?");
    $res = $update_query->execute([$name, $area, $price, $quantity, $adult, $children, $desc, $id]);

    if ($res) {
        $conn->prepare("DELETE FROM room_features WHERE id_room = ?")->execute([$id]);
        if (isset($_POST['features'])) {
            foreach ($_POST['features'] as $feature_id) {
                $conn->prepare("INSERT INTO room_features (id_room, id_features) VALUES (?, ?)")->execute([$id, $feature_id]);
            }
        }

        $conn->prepare("DELETE FROM room_facilities WHERE id_room = ?")->execute([$id]);
        if (isset($_POST['facilities'])) {
            foreach ($_POST['facilities'] as $facility_id) {
                $conn->prepare("INSERT INTO room_facilities (id_room, id_facilities) VALUES (?, ?)")->execute([$id, $facility_id]);
            }
        }

        echo 1;
    } else {
        echo 0;
    }
}
?>