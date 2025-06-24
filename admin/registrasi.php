<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Registrasi User</title>
    <link rel="icon" type="image/png" href="../logo.png">
    <style>
        .custom-card {
            max-width: 600px; /* Adjust the maximum width as needed */
            padding: 20px; /* Adjust the padding as needed */
            margin: auto; /* Center the card horizontally */
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
                        <a class="btn btn-outline-info me-2" href="data.php">Data</a>
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
<br><br>
<div class="card custom-card">
    <h1 class="h4">Buat Akun Pengguna</h1>
    <form action="process_create_user.php" method="POST">
        <div class="mb-3">
            <label for="nama" class="form-label">Nama:</label>
            <input type="text" id="nama" name="nama" class="form-control form-control-sm" required>
        </div>
        <div class="mb-3">
            <label for="username" class="form-label">Username:</label>
            <input type="text" id="username" name="username" class="form-control form-control-sm" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password:</label>
            <input type="password" id="password" name="password" class="form-control form-control-sm" required>
        </div>
        <div class="mb-3">
            <label for="level">Level:</label>
            <select id="level" name="level" class="form-select form-select-sm" required>
                <option value="admin">Admin</option>
                <option value="pegawai">Pegawai</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary btn-sm" name="submit">Buat Akun</button>
    </form>
</div>

<!-- Bootstrap JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
