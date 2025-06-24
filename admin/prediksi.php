<?php
session_start();

date_default_timezone_set('Asia/Makassar');

// cek apakah yang mengakses halaman ini sudah login
if ($_SESSION['level'] == "") {
    header("location:index.php?pesan=gagal");
}

include 'koneksi.php';

// Contoh dataset transaksi keuangan
$dataset = array(
    array(1000, 'Biasa', 'Sah'),
    array(2000, 'Biasa', 'Sah'),
    array(500, 'Mencurigakan', 'Penipuan'),
    array(3000, 'Biasa', 'Sah'),
    array(1500, 'Mencurigakan', 'Penipuan'),
    array(2500, 'Biasa', 'Sah')
);

// Hitung jumlah total transaksi
$total_transaksi = count($dataset);

// Hitung jumlah transaksi yang sah dan penipuan
$jumlah_sah = 0;
$jumlah_penipuan = 0;

foreach ($dataset as $data) {
    if ($data[2] == 'Sah') {
        $jumlah_sah++;
    } else {
        $jumlah_penipuan++;
    }
}

// Hitung probabilitas transaksi yang sah dan penipuan
$probabilitas_sah = $jumlah_sah / $total_transaksi;
$probabilitas_penipuan = $jumlah_penipuan / $total_transaksi;

// Fungsi untuk menghitung probabilitas kelas berdasarkan fitur
function hitungProbabilitas($fitur, $nilai, $kelas, $dataset) {
    $total_fitur_kelas = 0;
    $total_kelas = 0;

    foreach ($dataset as $data) {
        if ($data[2] == $kelas) {
            $total_kelas++;
            if ($data[$fitur] == $nilai) {
                $total_fitur_kelas++;
            }
        }
    }

    return $total_fitur_kelas / $total_kelas;
}

// Fungsi untuk melakukan prediksi
function prediksi($fitur1, $nilai1, $fitur2, $nilai2, $dataset) {
    global $probabilitas_sah, $probabilitas_penipuan;

    // Hitung probabilitas kelas "Sah"
    $probabilitas_sah_diketahui_fitur = $probabilitas_sah * hitungProbabilitas($fitur1, $nilai1, 'Sah', $dataset) * hitungProbabilitas($fitur2, $nilai2, 'Sah', $dataset);

    // Hitung probabilitas kelas "Penipuan"
    $probabilitas_penipuan_diketahui_fitur = $probabilitas_penipuan * hitungProbabilitas($fitur1, $nilai1, 'Penipuan', $dataset) * hitungProbabilitas($fitur2, $nilai2, 'Penipuan', $dataset);

    // Lakukan prediksi
    if ($probabilitas_sah_diketahui_fitur > $probabilitas_penipuan_diketahui_fitur) {
        return "Sah";
    } else {
        return "Penipuan";
    }
}

if (isset($_POST["submit"])) {
    $nama_nasabah = $_POST["nama_nasabah"];
    $alamat = $_POST["alamat"];
    $nilai_setoran = $_POST["nilai_setoran"];
    $no_rekening = $_POST["no_rekening"];
    $keterangan = $_POST["keterangan"];
    $nama_petugas = $_POST["nama_petugas"];

    // Lakukan prediksi apakah transaksi merupakan sah atau penipuan
    $prediksi = prediksi(2, $nilai_setoran, 3, $keterangan, $dataset);

    // Simpan prediksi ke database atau lakukan tindakan lain sesuai dengan kebutuhan Anda
    // Misalnya:
    $query = "INSERT INTO tb_data (nama_nasabah, alamat, nilai_setoran, no_rekening, keterangan, nama_petugas, prediksi) VALUES ('$nama_nasabah', '$alamat', '$nilai_setoran', '$no_rekening', '$keterangan','$nama_petugas', '$prediksi')";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "<script type='text/javascript'>alert('Data Terkirim');</script>";
    } else {
        echo "<script type='text/javascript'>alert('Gagal Mengirim Data');</script>";
    }
}
?>
