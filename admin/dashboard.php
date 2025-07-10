<?php
require('../public/db_config.php');
require('../server/class/dashboard.php');
?>

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

    .dashboard-card {
        border-radius: 16px;
        padding: 20px;
        color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
    }

    .card-title {
        font-size: 1rem;
        font-weight: 500;
    }

    .card-value {
        font-size: 2rem;
        font-weight: 700;
    }

    .chart-container {
        height: 300px;
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
                <h3 class="mb-4">DASHBOARD</h3>
                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <div class="dashboard-card bg-primary text-white">
                            <div class="card-title">จำนวนการจองทั้งหมด</div>
                            <div class="card-value"><?= $totalBookings ?></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="dashboard-card bg-info text-white">
                            <div class="card-title">จำนวนห้องที่ถูกจอง</div>
                            <div class="card-value"><?= $totalBookedRooms ?></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="dashboard-card bg-success text-white">
                            <div class="card-title">รายได้รวม</div>
                            <div class="card-value">฿<?= number_format($totalRevenue, 2) ?></div>
                        </div>
                    </div>
                </div>

                <div class="row g-4 mt-4">
                    <div class="col-md-6">
                        <div class="card p-4">
                            <h6 class="fw-bold mb-3">สถานะการจอง</h6>
                            <canvas id="bookingStatusChart"></canvas>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card p-4">
                            <h6 class="fw-bold mb-3">ห้องที่ได้รับความนิยมสูงสุด</h6>
                            <canvas id="popularRoomsChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require('../public/script.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
    const bookingStatusCtx = document.getElementById('bookingStatusChart').getContext('2d');
    const popularRoomsCtx = document.getElementById('popularRoomsChart').getContext('2d');

    const bookingStatusData = {
        labels: ['Pending', 'Completed', 'Cancelled', 'Refunding'],
        datasets: [{
            label: 'จำนวนการจอง',
            data: [
                <?= $statusCounts['pending'] ?>,
                <?= $statusCounts['completed'] ?>,
                <?= $statusCounts['cancelled'] ?>,
                <?= $statusCounts['refunding'] ?>
            ],
            backgroundColor: ['#facc15', '#4ade80', '#f87171', '#60a5fa']
        }]
    };

    const popularRoomsData = {
        labels: <?= json_encode($topRoomNames) ?>,
        datasets: [{
            label: 'จำนวนการจอง',
            data: <?= json_encode($topRoomCounts) ?>,
            backgroundColor: '#3b82f6'
        }]
    };

    new Chart(bookingStatusCtx, {
        type: 'bar',
        data: bookingStatusData,
        options: {
            responsive: true,
            indexAxis: 'y',
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                x: {
                    beginAtZero: true
                }
            }
        }
    });

    new Chart(popularRoomsCtx, {
        type: 'bar',
        data: popularRoomsData,
        options: {
            responsive: true,
            indexAxis: 'y',
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                x: {
                    beginAtZero: true
                }
            }
        }
    });
    </script>
</body>

</html>