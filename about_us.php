<?php
include 'koneksi.php';

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>About Us - Pudding Hambali</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark custom-navbar">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">Pudding Hambali</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <?php if (isset($_SESSION['pengguna'])) { ?>
                        <li class="nav-item"><a class="nav-link" href="riwayat_pesanan.php">Riwayat Pesanan</a></li>
                        <li class="nav-item"><a class="nav-link" href="keranjang.php">Keranjang</a></li>
                        <li class="nav-item"><a class="nav-link" href="profil.php">Profil</a></li>
                        <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                        <?php if (isset($_SESSION['pengguna']) && $_SESSION['pengguna']['role'] == 'admin') { ?>
                            <li class="nav-item"><a class="nav-link" href="dashboard_admin.php">Admin</a></li>
                        <?php } ?>
                    <?php } else { ?>
                        <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                        <li class="nav-item"><a class="nav-link" href="register.php">Register</a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        <div class="row d-flex justify-content-center gap-4">
            <div class="card shadow" style="width: 18rem;">
                <img src="PuddingHambali_ProjekAkhirPraktikumPWD_005_023/images/puddingcaramel.jpg" class="card-img-top"
                    alt="...">
                <div class="card-body">
                    <p class="card-text">
                        Nama : Farih Rakan Abqori <br>
                        NIM : 124250005 <br>
                        Kelas : SI-A
                    </p>

                </div>
            </div>
            <div class="card shadow" style="width: 18rem;">

                <img src="PuddingHambali_ProjekAkhirPraktikumPWD_005_023/images/puddingcaramel.jpg" class="card-img-top"
                    alt="...">

                <div class="card-body">

                    <p class="card-text">
                        Nama : Arsi Candra Kusuma <br>
                        NIM : 124250023 <br>
                        Kelas : SI-A
                    </p>

                </div>
            </div>
            <div class="d-flex justify-content-center mt-4">
                <button type="button" class="btn custom-btn bg-dark" onclick="window.history.back()">Kembali</button>

            </div>
        </div>

    </div>

    <footer class="custom-footer text-center mt-5 p-3">
        <p>&copy; 2026 Pudding Hambali Termoney-money 😹 | All Rights Reserved</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>