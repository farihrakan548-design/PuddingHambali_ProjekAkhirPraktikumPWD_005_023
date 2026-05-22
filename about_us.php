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

 <div class="container mt-5" id="products">

    <div class="row justify-content-center g-4">

        <div class="col-md-3">
            <div class="card custom-card h-100 shadow">
                <img src="Images/Rakan.JPEG"class="card-img-top"alt="005">
                <div class="card-body text-center">
                    <h5 class="section-title mb-3">Farih Rakan Abqori</h5>
                    <p>NIM : 124250005</p>
                    <p>Kelas : SI-A</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card custom-card h-100 shadow">
                <img src="Images/Candra.JPEG" class="card-img-top"alt="023">
                <div class="card-body text-center">
                    <h5 class="section-title mb-3">Arsi Candra Kusuma</h5>
                    <p>NIM : 124250023</p>
                    <p>Kelas : SI-A</p>
                </div>
            </div>
        </div>
    </div>
</div>
    <footer class="custom-footer text-center mt-5 p-4">
        <div class="container">
            <h5 class="fw-bold mb-2">Pudding Hambali</h5>
            <p class="mb-2">
                Puding premium dengan rasa terbaik untuk menemani setiap momen spesial Anda.
            </p>

            <p class="mb-1">📍 Yogyakarta, Indonesia</p>
            <p class="mb-1">📞 +62 812-1544-2566</p>
            <p class="mb-3">📧 info@puddinghambali.com</p>

            <small>&copy; 2026 Pudding Hambali Termoney-money 😹 | All Rights Reserved</small>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>