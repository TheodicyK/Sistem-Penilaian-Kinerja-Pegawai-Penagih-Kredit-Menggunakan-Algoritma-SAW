<?php 
	if(isset($_GET['pesan'])){
		if($_GET['pesan']=="gagal"){
			?>
            <script type="text/javascript">
                alert("username dan password tidak sesuai");
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
    <title>Halaman Login</title>
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
    background-image: url('net.jpg');
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
        width: 30%;
        margin: 0 auto;
    }
}

    </style>
</head>
<body>
    <div class="card">
        <span class="border-bottom border-5">
            <h1 class="text-center p-2" style="font-size: 10px "><p><img id="logo" src="logobpr.png" alt="logo"></p></h1>
            <h3 style="text-align: center;" class="black-text">APLIKASI MONITORING PEGAWAI</h3>
            <h6 style="text-align: center;" class="black-text"></h6>
            <hr class="border border-primary border-2 opacity-100">
            <h5 style="text-align: center;" class="black-text">LOGIN</h5>
            
            <br>
            <form action="cek_login.php" method="post">
                <div class="mb-3">
                    <label for="username">Masukan Username</label>
                    <input id="username" type="text" name="username" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="password">Masukan Password</label>
                    <input id="password" type="password" name="password" class="form-control" required>
                </div>
                <br>
				<div class="form-group">
               		<input type="submit" name="login" value="LOGIN" class="btn btn-primary">
            	</div>
                <a href="index.php" class="btn btn-secondary">Dashboard</a>

            </form>
            <br>
            <footer><img src="footer1.png" alt="foto"></footer>
        </span>
    </div>

</body>
</html>