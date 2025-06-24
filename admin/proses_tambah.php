<?php
// Cek apakah form dikirim dengan metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $nama_nasabah = $_POST['nama_nasabah'];
    $alamat = $_POST['alamat'];
    $setoran = $_POST['setoran'];
    $no_rek = $_POST['no_rek'];
    $nama_petugas = $_POST['nama_petugas'];

    // Tampilkan data ke layar (konfirmasi)
    echo "<h3>Data yang Diterima:</h3>";
    echo "Nama Nasabah: $nama_nasabah<br>";
    echo "Alamat: $alamat<br>";
    echo "Setoran: $setoran<br>";
    echo "No Rekening: $no_rek<br>";
    echo "Nama Petugas: $nama_petugas<br>";

    // Koneksi ke database
    $conn = new mysqli("localhost", "root", "", "monitoring");

    // Cek koneksi
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Simpan ke tabel tb_datanasabah
    $sql = "INSERT INTO tb_datanasabah (nama_nasabah, alamat, setoran, no_rek, nama_petugas)
            VALUES ('$nama_nasabah', '$alamat', '$setoran', '$no_rek', '$nama_petugas')";

    if ($conn->query($sql) === TRUE) {
        echo "<p style='color: green;'>Data berhasil disimpan ke database.</p>";
    } else {
        echo "<p style='color: red;'>Gagal menyimpan data: " . $conn->error . "</p>";
    }

    $conn->close();
}
?>
