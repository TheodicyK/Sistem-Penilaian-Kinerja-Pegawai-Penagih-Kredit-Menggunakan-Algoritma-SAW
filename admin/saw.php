<?php
include '../koneksi.php';

// Mendefinisikan fungsi untuk menentukan kategori nilai setoran
function konversiSetoran($nilai_setoran) {
    if (!empty($nilai_setoran)) {
        return 2;
    } else {
        return 0;
    }
}

// Mendefinisikan fungsi untuk mengonversi keterangan ke nilai numerik
function konversiKeterangan($keterangan) {
    if (!empty($keterangan)) {
        return 2;
    } else {
        return 0;
    }
}

// Mendefinisikan fungsi untuk mengonversi foto ke nilai numerik
function konversiFoto($foto) {
    if (!empty($foto)) {
        return 2;
    } else {
        return 0;
    }
}

// Kriteria dan bobot
$kriteria = array('nilai_setoran' => 0.5, 'keterangan' => 0.5, 'nama_petugas' => 0.5, 'foto' => 0.5);
$total_bobot = array_sum($kriteria);

foreach ($kriteria as $kriteria_key => $bobot) {
    if (!is_numeric($bobot)) {
        echo "Bobot kriteria '$kriteria_key' bukanlah angka.";
    }
}

// Ambil data yang sudah di-approve dari database
$rows = mysqli_query($koneksi, "SELECT * FROM tb_data WHERE status_approve = 'approved' ORDER BY id DESC");

// Inisialisasi array untuk menyimpan nilai akhir
$nilai_akhir = array();

// Hitung nilai normalisasi untuk setiap kriteria dan setiap alternatif
foreach ($rows as $row) {
    $nama_petugas = $row['nama_petugas'];
    $nilai_setoran = $row['nilai_setoran'];
    $keterangan = $row['keterangan'];
    $foto = $row['foto'];

    

    // Menghitung nilai keterangan dan foto
    $nilai_keterangan = konversiKeterangan($keterangan);
    $nilai_foto = konversiFoto($foto);
    $nilai_setoran = konversiSetoran($nilai_setoran);

    // Menghitung perhitungan SAW
    $perhitungan_saw = $bobot * (($nilai_setoran * $kriteria['nilai_setoran']) + ($nilai_keterangan * $kriteria['keterangan']) + ($kriteria['nama_petugas']) + ($nilai_foto * $kriteria['foto']));
    
    if (!isset($nilai_akhir[$nama_petugas])) {
        $nilai_akhir[$nama_petugas] = 0;
    }
    $nilai_akhir[$nama_petugas] += $perhitungan_saw * 1;
}

// Membulatkan nilai akhir
foreach ($nilai_akhir as &$nilai) {
    $nilai = round($nilai, 2);
}

arsort($nilai_akhir);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Perangkingan SAW</title>
    <link rel="icon" type="image/png" href="../logo.png">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        .custom-card {
            max-width: 1500px;
            padding: 20px;
            margin: auto;
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
                <li class="nav-item ms-auto">
                    <a class="btn btn-outline-danger me-2" aria-current="page" href="../logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<br>
<div class="card custom-card">
    <div class="card">
        <h2 class="fw-bold text-center">Hasil Perangkingan SAW</h2>
    </div>
    <br>
    <table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Petugas</th>
            <th>Nilai Akhir</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $no = 1;
        foreach ($nilai_akhir as $nama_petugas => $total_nilai_saw): 
        ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $nama_petugas; ?></td>
                <td><?php echo $total_nilai_saw; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

    <br>
    <h3>Kriteria Bobot</h3>
    <table>
        <thead>
            <tr>
                <th>Kriteria</th>
                <th>Bobot</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($kriteria as $kriteria_key => $bobot): ?>
                <tr>
                    <td><?php echo $kriteria_key; ?></td>
                    <td><?php echo $bobot; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <br>
    <h3>Tabel Perhitungan</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Petugas</th>
                <th>Nilai Setoran (Konversi)</th>
                <th>Keterangan (Numerik)</th>
                <th>Foto (Numerik)</th>
                <th>Perhitungan SAW</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1;
            foreach ($rows as $row): 
                $nama_petugas = $row['nama_petugas'];
                $nilai_setoran = $row['nilai_setoran'];
                $keterangan = $row['keterangan'];
                $foto = $row['foto'];
                $nilai_setoran = konversiSetoran($nilai_setoran);
                $nilai_keterangan = konversiKeterangan($keterangan);
                $nilai_foto = konversiFoto($foto);
                $perhitungan_saw = $bobot * (($nilai_setoran * $kriteria['nilai_setoran']) + ($nilai_keterangan * $kriteria['keterangan']) + ($kriteria['nama_petugas']) + ($nilai_foto * $kriteria['foto']));
            ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $nama_petugas; ?></td>
                    <td><?php echo $nilai_setoran; ?></td>
                    <td><?php echo $nilai_keterangan; ?></td>
                    <td><?php echo $nilai_foto; ?></td>
                    <td><?php echo $perhitungan_saw; ?> = <?php echo $bobot; ?> * (<?php echo $nilai_setoran; ?> * <?php echo $kriteria['nilai_setoran']; ?>) + (<?php echo $nilai_keterangan; ?> * <?php echo $kriteria['keterangan']; ?>) + (<?php echo $kriteria['nama_petugas']; ?>) + (<?php echo $nilai_foto; ?> * <?php echo $kriteria['foto']; ?>)</td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
