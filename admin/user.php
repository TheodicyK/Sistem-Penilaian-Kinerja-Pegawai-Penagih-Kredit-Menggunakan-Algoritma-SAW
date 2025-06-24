<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Data User</title>
    <link rel="icon" type="image/png" href="../logo.png">
    <style>
        .custom-card {
            max-width: 1500px;
            padding: 20px;
            margin: auto;
        }
    </style>
  </head>
  <body>

  <?php
  // Include file koneksi
  include '../koneksi.php';

  // Query untuk mengambil data pengguna dengan level 'pegawai' atau 'admin'
  $query = "SELECT * FROM tb_user WHERE level IN ('pegawai', 'admin')";
  $result = mysqli_query($koneksi, $query);

  if ($result) {
  ?>
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
              <a class="btn btn-outline-info me-2" href="index.php">Home</a>
            </li>
            <li class="nav-item">
                        <a class="btn btn-outline-info me-2" href="data.php">Data</a>
                    </li>
            <li class="nav-item">
              <a class="btn btn-outline-info me-2" href="laporan.php">Laporan</a>
            </li>
            <li class="nav-item">
              <a class="btn btn-outline-info me-2" href="registrasi.php">Registrasi</a>
            </li>
            <li class="nav-item">
              <a class="btn btn-outline-info me-2" href="user.php">User</a>
            </li>
            <li class="nav-item">
              <a class="btn btn-outline-info me-2" href="saw.php">Penilaian Kinerja</a>
            </li>
            <li class="nav-item ms-auto">
              <a class="btn btn-outline-danger me-2" href="../logout.php">Logout</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <br><br>

    <div class="card custom-card">
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nama</th>
              <th>Username</th>
              <th>Level</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
              while ($row = mysqli_fetch_assoc($result)) {
            ?>
              <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['nama']; ?></td>
                <td><?php echo $row['username']; ?></td>
                <td><?php echo $row['level']; ?></td>
                <td>
                  <form method="post" action="delete.php" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?');">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                  </form>
                </td>
              </tr>
            <?php
              }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  <?php
  } else {
      echo "Error: " . mysqli_error($koneksi);
  }

  // Tutup koneksi database
  mysqli_close($koneksi);
  ?>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  </body>
</html>
