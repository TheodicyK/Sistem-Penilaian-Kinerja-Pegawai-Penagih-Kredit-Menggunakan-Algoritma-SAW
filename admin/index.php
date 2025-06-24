<?php
session_start();

// Periksa apakah pengguna sudah login sebagai admin
if ($_SESSION['level'] !== "admin") {
    header("location:index.php?pesan=gagal");
    exit(); // Pastikan untuk menghentikan eksekusi skrip setelah mengalihkan
}
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Dashboard Admin</title>
    <link rel="icon" type="image/png" href="../logo.png">
    <style>
        .notification {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            margin-top: 20px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="nav nav-pills">
                <div class="container">
                    <a class="navbar-brand" href="#">
                        <img src="../logobpr.png" alt="" width="400" height="60" style="max-width: 300px; max-height: 100px;">
                    </a>
                </div>
                <li class="nav-item">
                    <a class="btn btn-outline-info me-2" aria-current="page" href="dashboard.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-outline-info me-2" aria-current="page" href="data.php">Data</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-outline-info me-2" aria-current="page" href="laporan.php">Laporan</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-outline-info me-2" aria-current="page" href="registrasi.php">Registrasi</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-outline-info me-2" aria-current="page" href="user.php">User</a>
                </li>
                <li class="nav-item">
                        <a class="btn btn-outline-info me-2" aria-current="page" href="saw.php">Penilaian Kinerja</a>
                    </li>
                <li  class="nav-item ms-auto">
                    <a class="btn btn-outline-danger me-2" aria-current="page" href="../logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container mt-4">
    <h1>Dashboard Admin</h1>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
