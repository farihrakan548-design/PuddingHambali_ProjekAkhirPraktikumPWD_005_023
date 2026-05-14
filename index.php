<?php include 'koneksi.php';
$produk = mysqli_query($conn, "SELECT * FROM produk WHERE stok > 0");
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pudding Hambali</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

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
                    <li class="nav-item"><a class="nav-link" href="about_us.php">About Us</a></li>
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

    <section class="header">
        <div class="container text-center">
            <h1 class="display-4 section-title mt-4">Welcome to Pudding Hambali</h1>
            <p class="section-title">Pudding lezat aseli ngawi. ownernya Pak Hambali</p>
        </div>
    </section>

    <div class="container mt-5" id="products">
        <h2 class="text-center mb-4 section-title">Pudding Kita</h2>
        <div class="row g-4" id="produk">
            <?php
            while ($p = mysqli_fetch_assoc($produk)) { ?>
                <div class="col-md-3">
                    <div class="card custom-card">
                        <img src="<?php echo $p['gambar']; ?>" class="card-img-top">
                        <div class="card-body text-center">
                            <h5 class="section-title"><?php echo $p['nama_produk']; ?></h5>
                            <p><?php echo $p['deskripsi']; ?></p>
                            <p>Rp. <?php echo $p['harga']; ?></p>
                            <p>Stok: <?php echo $p['stok']; ?></p>
                            <a href="proses_tambah_keranjang.php?id=<?php echo $p['id_produk']; ?>" class="btn custom-btn"
                                onclick="return confirm('tambah ke keranjang?')">Tambah ke Keranjang</a>
                        </div>
                    </div>
                </div>
            <?php } ?>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

<footer class="custom-footer text-center mt-5 p-3">
    <p>&copy; 2026 Pudding Hambali Termoney-money 😹 | All Rights Reserved</p>
</footer>

</html>