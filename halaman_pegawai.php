<?php
session_start();

date_default_timezone_set('Asia/Makassar');

// cek apakah yang mengakses halaman ini sudah login
if ($_SESSION['level'] == "") {
    header("location:index.php?pesan=gagal");
}

include 'koneksi.php';

if (isset($_POST["submit"])) {
    $nama_nasabah = $_POST["nama_nasabah"];
    $alamat = $_POST["alamat"];
    $nilai_setoran = preg_replace('/[^0-9]/', '', $_POST["nilai_setoran"]);
    $no_rekening = $_POST["no_rekening"];
    $keterangan = $_POST["keterangan"];
    $nama_petugas = $_POST["nama_petugas"];


    // Check if the "foto" file was uploaded
    if (!empty($_FILES["foto"]["name"])) {
        // Validate file type
        $allowed_types = array('png', 'jpg', 'jpeg');
        $file_extension = pathinfo($_FILES["foto"]["name"], PATHINFO_EXTENSION);

        if (in_array(strtolower($file_extension), $allowed_types)) {
            $foto = $_FILES["foto"]["name"];
            $latitude = $_POST["latitude"];
            $longitude = $_POST["longitude"];
            $tanggal_penginputan = date("Y-m-d");
            $jam_penginputan = date("H:i:s");

            $upload_dir = "uploads/";

            if (move_uploaded_file($_FILES["foto"]["tmp_name"], $upload_dir . $foto)) {
                // File diunggah dengan sukses
                $query = "INSERT INTO tb_data (nama_nasabah, alamat, nilai_setoran, no_rekening, keterangan, nama_petugas, foto, latitude, longitude, tanggal_penginputan, jam_penginputan) VALUES ('$nama_nasabah', '$alamat', '$nilai_setoran', '$no_rekening', '$keterangan', '$nama_petugas', '$foto', '$latitude', '$longitude', '$tanggal_penginputan', '$jam_penginputan')";
                $result = mysqli_query($koneksi, $query);

                if ($result) {
                    ?>
                    <script type="text/javascript">
                        alert("Data Terkirim");
                    </script>
                    <?php
                } else {
                    ?>
                    <script type="text/javascript">
                        alert("Gagal Mengirim Data");
                    </script>
                    <?php
                }
            } else {
                ?>
                <script type="text/javascript">
                    alert("Gagal Mengunggah File");
                </script>
                <?php
            }
        } else {
            ?>
            <script type="text/javascript">
                alert("Tipe File Tidak Diperbolehkan. Hanya file PNG dan JPG yang diperbolehkan.");
            </script>
            <?php
        }
    } else {
        // Handle the case when no "foto" file is uploaded
        ?>
        <script type="text/javascript">
            alert("Pilih File Foto Terlebih Dahulu");
        </script>
        <?php
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Monitoring</title>
    <link rel="icon" type="image/png" href="logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f0f0f0;
    margin: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
}

.container {
    text-align: center;
}

.card {
    padding: 50px;
    width: 80%; /* Menggunakan lebar yang lebih besar pada tampilan layar yang lebih kecil */
    margin: 0 auto;
    margin-top: 10%;
    background-color: #ffffff;
    border: 1px solid rgba(0, 0, 0, 0.125);
    border-radius: 10px;
    background-image: url();
    background-size: cover;
    background-position: center;
}

img {
    max-width: 100%;
    height: auto;
    margin-right: auto;
    margin-left: auto; /* Pusatkan gambar */
    display: block;
}

img#logo {
    max-width: 80%; /* Mengurangi lebar logo pada tampilan layar yang lebih kecil */
    height: auto;
    margin: 0;
    position: absolute;
    top: 20px;
    right: 10%;
}

/* Gaya tambahan untuk tombol login */
input[type="submit"] {
    width: 80%; /* Menggunakan lebar yang lebih besar pada tampilan layar yang lebih kecil */
    padding: 12px;
    margin: 0 auto; /* Pusatkan tombol */
    display: block;
}

@media screen and (min-width: 768px) {
    /* Gaya tambahan untuk tampilan layar yang lebih besar dari 768px */
    .card {
        width: 40%;
    }

    img#logo {
        max-width: 60%;
        right: 20%;
    }

    input[type="submit"] {
        width: 20%;
        margin: 0 auto;
    }
}

    </style>
</head>
<body onload="getLocation();">
    <div class="card">
        <span class="border-bottom border-5">
            <h1 class="text-center p-2" style="font-size: 10px "><p><img id="logo" src="logobpr.png" alt="logo"></p></h1>
            <h3 style="text-align: center;" class="black-text">MONITORING PEGAWAI</h3>
            <h6 style="text-align: center;" class="black-text"></h6>
            <hr class="border border-primary border-2 opacity-100">
            <h5 style="text-align: center;" class="black-text"></h5>
            <p>Halo <b><?php echo $_SESSION['username']; ?></b> Anda telah login sebagai <b><?php echo $_SESSION['level']; ?></b>.</p>
            <br>
            <form class="myForm" action="" method="post" enctype="multipart/form-data" autocomplete="off">
                <div class="mb-3">
                    <label for="">Masukan Nama Debitur</label>
                    <input id="nama_nasabah" type="text" name="nama_nasabah" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Masukan Alamat Debitur</label>
                    <input id="alamat" type="text" name="alamat" class="form-control" required>
                </div>          
                <div class="form-group">
                <label for="">Masukan Jumlah Setoran (Rupiah)</label>
                <input id="nilai_setoran" type="text" name="nilai_setoran" class="form-control" required>
            </div>
                <div class="form-group">
                    <label for="">Masukan Nomor Rekening Nasabah</label>
                    <input id="no_rekening" type="text" name="no_rekening" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Catatan</label>
                    <textarea id="Keterangan" type="text" name="keterangan" class="form-control" required></textarea>
                </div>
                 <div class="form-group">
                    <label for="nama_petugas">Masukan Nama Petugas</label>
                        <select id="nama_petugas" name="nama_petugas" class="form-control" required>
                            <option value="">-- Pilih Petugas --</option>
                            <option value="Maedelino Suak">Maedelino Suak</option>
                            <option value="Michael Pontoh">Michael Pontoh</option>
                            <option value="Christian Rawung">Christian Rawung</option>
                            <option value="Ridels Piri">Ridels Piri</option>
                            <option value="Andro Wungow">Andro Wungow</option>
                            <option value="Charles Tombuku">Charles Tombuku</option>
                        </select>
                </div>
                <div class="form-group">
                    <label for="">Bukti Foto</label>
                    <input id="foto" type="file" name="foto" class="form-control" required>
                </div>
                <div class="form-group">
                    <input id="" type="hidden" name="latitude" class="form-control">
                </div>
                <div class="form-group">
                    <input id="" type="hidden" name="longitude" class="form-control">
                </div>
                <br>
                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
				<a class="btn btn-danger" href="logout.php">Logout</a>
				<a class="btn btn-warning" href="ganti.php">Ganti Password</a>
                
                <br>
                
            </form>
            <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places" async defer></script>
            <script>
                function getLocation() {
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(showPosition);
                    }
                }

                function showPosition(position) {
                    document.querySelector('.myForm input[name="latitude"]').value = position.coords.latitude;
                    document.querySelector('.myForm input[name="longitude"]').value = position.coords.longitude;
                }
            </script>
            <br>
            <footer><img src="footer1.png" alt="foto"></footer>
        </span>
    </div>
    <script>
        function formatRupiah(angka, prefix) {
            var number_string = angka.toString().replace(/[^,\d]/g, ''),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix === undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }

        // Panggil fungsi formatRupiah saat nilai input berubah
        document.getElementById('nilai_setoran').addEventListener('keyup', function(e) {
            // Hapus karakter non-digit dari nilai input
            var inputNilai = e.target.value.replace(/\D/g, '');
            // Berikan format rupiah pada nilai input
            e.target.value = formatRupiah(inputNilai, 'Rp. ');
        });
    </script>

</body>
</html>


