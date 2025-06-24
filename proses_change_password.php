<?php
session_start();
include 'koneksi.php';

if (isset($_POST['submit'])) {
    $username = $_SESSION['username'];
    $new_password = $_POST['new_password'];

    $query = "UPDATE tb_user SET password = '$new_password' WHERE username = '$username'";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "<script>alert('Password berhasil diubah');</script>";
    } else {
        echo "<script>alert('Gagal mengubah password');</script>";
    }
}
?>
