<?php
include '../koneksi.php';

// Handle approval
if (isset($_POST['approve'])) {
    $id = $_POST['id'];
    $update_query = "UPDATE tb_data SET status_approve = 'approved' WHERE id = $id";
    mysqli_query($koneksi, $update_query);
    header("Location: laporan.php"); // Redirect to avoid resubmission
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet">
    <title>Data Laporan</title>
    <link rel="icon" type="image/png" href="../logo.png">
    <style>
        .print-table {
            overflow: visible;
        }

        @media print {
            .navbar, .btn {
                display: none;
            }

            .container {
                margin-top: 0;
            }
        }
        
        .custom-card {
            max-width: 1700px; /* Adjust the maximum width as needed */
            padding: 20px; /* Adjust the padding as needed */
            margin: auto; /* Center the card horizontally */
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
                    <li> 
                        <button onclick="customPrintFunction()" class="btn btn-outline-primary me-2" aria-current="page" href="">Print</button>
                        <script>
                            function customPrintFunction() {
                                window.print(); 
                            }
                        </script>
                    </li>
                    <li  class="nav-item ms-auto">
                        <a class="btn btn-outline-danger me-2" aria-current="page" href="../logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <br><br>
<div class="card custom-card">
    <table id="laporan-table" class="table table-bordered table-responsive-sm">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Nasabah</th>
                <th>Alamat Nasabah</th>
                <th>Nilai Setoran</th>
                <th>No. Rekening</th>
                <th>Keterangan</th>
                <th>Nama Petugas</th>
                <th>Bukti Foto</th>
                <th>Maps</th>
                <th>Tanggal Penginputan</th>
                <th>Jam Penginputan</th>
                <th>Approve</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $rows = mysqli_query($koneksi, "SELECT * FROM tb_data ORDER BY id DESC");
            $i = 1;

            foreach ($rows as $row) :
            ?>
            <tr>
                <td><?php echo $i++ ?></td>
                <td><?php echo $row["nama_nasabah"] ?></td>
                <td><?php echo $row["alamat"] ?></td>
                <td><?php echo $row["nilai_setoran"] ?></td>
                <td><?php echo $row["no_rekening"] ?></td>
                <td><?php echo $row["keterangan"] ?></td>
                <td><?php echo $row["nama_petugas"] ?></td>
                <td><img src="../uploads/<?php echo $row["foto"]; ?>" style="max-width: 100px;"></td>
                <td><iframe src="https://www.google.com/maps?q=<?php echo $row["latitude"];?>,<?php echo $row["longitude"]; ?>&hl=es;z=14&output=embed"></iframe></td>
                <td><?php echo $row["tanggal_penginputan"] ?></td>
                <td><?php echo $row["jam_penginputan"] ?></td>
                <td>
                    <?php if ($row["status_approve"] === 'pending'): ?>
                    <form method="POST">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <button type="submit" name="approve" class="btn btn-success">Approve</button>
                    </form>
                    <?php else: ?>
                    Approved
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#laporan-table').DataTable();
        });
    </script>
</body>
</html>
