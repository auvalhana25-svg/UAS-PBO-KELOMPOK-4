<?php
include "class/data.php";

$data = new Data();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>ShopeeFood Driver</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">

    <!-- CSS Sendiri -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg" style="background:#ff6d00;">
        <div class="container">

            <a class="navbar-brand text-white fw-bold" href="#">
                ShopeeFood Driver
            </a>

        </div>
    </nav>

    <div class="container mt-5">

        <!-- Menu -->
        <a href="driver.php" class="btn btn-warning text-white">
            CRUD Driver
        </a>

        <a href="order.php" class="btn btn-light">
            Daftar Order
        </a>

        <a href="riwayat.php" class="btn btn-light">
            Riwayat Pengantaran
        </a>

        <hr>

        <div class="text-center mt-5">

            <h2 class="text-warning">
                Selamat Datang
            </h2>

            <h4>
                Aplikasi Driver ShopeeFood
            </h4>

            <p>
                UAS Pemrograman Berorientasi Objek
            </p>

        </div>

    </div>

<script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>
</html>