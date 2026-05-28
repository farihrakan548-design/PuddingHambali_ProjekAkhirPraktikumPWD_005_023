<?php
include 'koneksi.php';

if (!isset($_SESSION['pengguna'])) {
    header("location: login.php");
    exit;
}

$id_pengguna = $_SESSION['pengguna']['id_pengguna'];
$profil = mysqli_query($conn, "SELECT * FROM pengguna WHERE id_pengguna='$id_pengguna';");

$pengguna = mysqli_fetch_assoc($profil);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark custom-navbar fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">Pudding Hambali</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="about_us.php">About Us</a></li>
                    <?php if (isset($_SESSION['pengguna'])) { ?>
                        <li class="nav-item"><a class="nav-link" href="riwayat_pesanan.php">Riwayat Pesanan</a></li>
                        <li class="nav-item"><a class="nav-link" href="keranjang.php">Keranjang</a></li>
                        <li class="nav-item"><a class="nav-link" href="logout.php" onclick="return confirm('Apakah Anda yakin ingin logout?')">Logout</a></li>
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

    <div class="row mt-5"></div>
    <div class="container py-5 mt-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card border-0 shadow-lg rounded-4">
                    <h2 class="section-title mt-4 mb-4 text-center">Profil</h2>
                    <div class="card-body p-5">
                        <table class="table">
                            <tr>
                                <th>ID</th>
                                <td>:</td>
                                <td><?php echo $pengguna['id_pengguna']; ?></td>
                            </tr>
                            <tr>
                                <th>Username</th>
                                <td>:</td>
                                <td><?php echo $pengguna['username'] ?></td>
                            </tr>
                            <tr>
                                <th>Nama Lengkap</th>
                                <td>:</td>
                                <td><?php echo $pengguna['nama_lengkap'] ?></td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>:</td>
                                <td><?php echo $pengguna['email'] ?> </td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                                <td>:</td>
                                <td><?php echo $pengguna['alamat'] ?> </td>
                            </tr>
                            <tr>
                                <th>Role</th>
                                <td>:</td>
                                <td><?php echo $pengguna['role'] ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="d-flex justify-content-center mt-4">
                    <button type="button" class="btn custom-btn bg-dark"
                        onclick="window.history.back()">Kembali</button>
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