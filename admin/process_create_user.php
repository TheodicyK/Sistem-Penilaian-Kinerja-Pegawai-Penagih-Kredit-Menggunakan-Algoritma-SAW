<?php
include '../koneksi.php';
// Sertakan koneksi ke database di sini

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Tangkap data dari formulir
    $nama = $_POST["nama"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $level = $_POST["level"];

    // Lakukan validasi data jika diperlukan

    // Lakukan penyisipan data ke dalam tabel tb_user
    $sql = "INSERT INTO tb_user (nama, username, password, level) VALUES (?, ?, ?, ?)";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("ssss", $nama, $username, $password, $level);

                    if ($stmt->execute()) {
                        ?>
                        <script type="text/javascript">
                            alert("User Berhasil Dibuat");
                            window.location.href = 'registrasi.php';
                        </script>
                        <?php
                    } else {
                        ?>
                        <script type="text/javascript">
                            alert("Gagal Membuat User");
                            window.location.href = 'registrasi.php';
                        </script>
                        <?php
                    }

    $stmt->close();
    // Tutup koneksi ke database jika diperlukan
}
?>
