<?php
include '../koneksi.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Gunakan prepared statement untuk keamanan
    $stmt = mysqli_prepare($koneksi, "DELETE FROM tb_user WHERE id = ?");
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            header("Location: user.php?pesan=success");
            exit();
        } else {
            header("Location: user.php?pesan=error");
            exit();
        }
        mysqli_stmt_close($stmt);
    } else {
        header("Location: user.php?pesan=error");
        exit();
    }
} else {
    header("Location: user.php?pesan=error");
    exit();
}

mysqli_close($koneksi);
?>

