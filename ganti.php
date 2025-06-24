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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center">Ganti Password</h2>
                <form method="post">
                    <div class="mb-3">
                        <label for="new_password" class="form-label">Masukan Password Baru:</label>
                        <input type="password" class="form-control" id="new_password" name="new_password" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="submit">Ganti Password</button>
                    <a class="btn btn-danger" href="logout.php">Logout</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
