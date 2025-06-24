<?php
// Koneksi ke database
$host = "localhost";
$user = "root";
$password = "";
$database = "monitoring";

$koneksi = mysqli_connect($host, $user, $password, $database);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Query data dari masing-masing tabel
$query1 = mysqli_query($koneksi, "SELECT COUNT(*) as jumlah FROM tb_data");
$data1 = mysqli_fetch_assoc($query1);

$query2 = mysqli_query($koneksi, "SELECT COUNT(*) as jumlah FROM tb_datanasabah");
$data2 = mysqli_fetch_assoc($query2);

$jumlah_tagih = $data1['jumlah'];
$jumlah_nasabah = $data2['jumlah'];
$jumlah_belum_tagih = $jumlah_nasabah - $jumlah_tagih;
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="msapplication-TileImage" content="https://bankprismadana.co.id/wp-content/uploads/2022/03/cropped-logo-kecil-270x270.png">
    <title>Dashboard</title>

    <!-- Tambahkan favicon -->
    <link rel="icon" type="image/png" href="logo.png">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('logobpr.png');
            background-size: contain;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center;
            color: #000;
        }

        .container, .navbar {
            background-color: rgba(255, 255, 255, 0.85);
            border-radius: 10px;
            padding: 10px;
        }

        .card-box {
            padding: 30px;
            color: #fff;
            border-radius: 12px;
            text-align: center;
            font-size: 22px;
            font-weight: bold;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease;
        }

        .card-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        }

        .blue    { background-color: #0d6efd; }
        .yellow { background-color: #ffc107; color: #212529; }
        .red   { background-color: #dc3545; }

        @media (max-width: 768px) {
            .card-box {
                font-size: 18px;
                padding: 20px;
            }
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light mb-3">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="logobpr.png" alt="Logo" width="200" class="img-fluid">
        </a>
        <div>
            <a class="btn btn-outline-info me-2" href="login.php">Login</a>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <h1 class="text-center">DASHBOARD</h1>
    <div class="row mt-4">
        <div class="col-md-4 mb-3">
            <div class="card-box blue">
                Data Yang Sudah Di Tagih<br>
                <span class="count" data-count="<?= $jumlah_tagih; ?>">0</span>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card-box yellow">
                Data Penagihan Nasabah<br>
                <span class="count" data-count="<?= $jumlah_nasabah; ?>">0</span>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card-box red">
                Data Yang Belum Di Tagih<br>
                <span class="count" data-count="<?= $jumlah_belum_tagih; ?>">0</span>
            </div>
        </div>
    </div>
</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Counter animation
    const counters = document.querySelectorAll('.count');
    counters.forEach(counter => {
        const updateCount = () => {
            const target = +counter.getAttribute('data-count');
            const count = +counter.innerText;
            const speed = 100; // the lower the slower
            const increment = Math.ceil(target / speed);

            if (count < target) {
                counter.innerText = count + increment;
                setTimeout(updateCount, 15);
            } else {
                counter.innerText = target;
            }
        };
        updateCount();
    });
</script>

</body>
</html>
