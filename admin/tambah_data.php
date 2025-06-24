<?php
// Cek apakah form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Ambil data dari form
    $nama_nasabah = $_POST['nama_nasabah'];
    $alamat = $_POST['alamat'];
    $setoran = $_POST['setoran'];
    $no_rek = $_POST['no_rek'];
    $nama_petugas = $_POST['nama_petugas'];

    // Koneksi ke database
    $conn = new mysqli("localhost", "root", "", "monitoring"); // ganti user/password jika perlu

    // Cek koneksi
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Simpan data dengan prepared statement
    $stmt = $conn->prepare("INSERT INTO tb_datanasabah (nama_nasabah, alamat, setoran, no_rek, nama_petugas) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssiss", $nama_nasabah, $alamat, $setoran, $no_rek, $nama_petugas);

    if ($stmt->execute()) {
        // Jika berhasil menyimpan, tampilkan pesan sukses
        $pesan = "Data berhasil disimpan.";
    } else {
        // Jika gagal menyimpan, tampilkan pesan error
        $pesan = "Gagal menyimpan data: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Form Tambah Data Nasabah</title>
    <link rel="icon" type="image/png" href="../logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f0f0;
            padding-top: 50px;
        }
        .card {
            width: 50%;
            margin: auto;
            padding: 30px;
            border-radius: 10px;
        }
        footer img {
            max-width: 100%;
            height: auto;
            margin-top: 30px;
        }
    </style>
</head>
<body>
<div class="card shadow">
    <h3 class="text-center">Tambah Data Nasabah</h3>
    
    <hr>
    
    <!-- Menampilkan pesan jika ada -->
    <?php if (isset($pesan)): ?>
        <div class="alert alert-info"><?php echo $pesan; ?></div>
    <?php endif; ?>

    <!-- Form untuk input data -->
    <form method="post" action="tambah_data.php" autocomplete="off">
        <div class="mb-3">
            <label for="nama_nasabah">Nama Nasabah</label>
            <input type="text" class="form-control" name="nama_nasabah" id="nama_nasabah" required>
        </div>
        <div class="mb-3">
            <label for="alamat">Alamat</label>
            <input type="text" class="form-control" name="alamat" id="alamat" required>
        </div>
        <div class="mb-3">
            <label for="setoran">Setoran</label>
            <input type="number" class="form-control" name="setoran" id="setoran" required>
        </div>
        <div class="mb-3">
            <label for="no_rek">Nomor Rekening</label>
            <input type="text" class="form-control" name="no_rek" id="no_rek">
        </div>
        <div class="mb-3">
            <label for="nama_petugas">Nama Petugas</label>
            <textarea class="form-control" name="nama_petugas" id="nama_petugas" required></textarea>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
        <a href="data.php" class="btn btn-danger">Kembali ke Halaman Data</a>
    </form>
         
    <footer>
        <img src="../footer1.png" alt="footer">
    </footer>
</div>

</body>
</html>
