<?php

include 'koneksi.php';

if (!isset($_SESSION['pengguna'])) {
    header("location: login.php");
    exit;
}

$id_pengguna = $_SESSION['pengguna']['id_pengguna'];
$data = mysqli_query($conn, "SELECT keranjang.*, produk.nama_produk, produk.harga, produk.gambar FROM keranjang JOIN produk ON keranjang.id_produk=produk.id_produk WHERE keranjang.id_pengguna='$id_pengguna';");

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

    <nav class="navbar navbar-expand-lg navbar-dark custom-navbar">
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
                        <li class="nav-item"><a class="nav-link" href="profil.php">Profil</a></li>
                        <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                    <?php } else { ?>
                        <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                        <li class="nav-item"><a class="nav-link" href="register.php">Register</a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        <div class="row g-4">
            <h2 class="section-title">Keranjang Anda</h2>
            <table class="table">
                <thead>
                    <tr class="table table-warning">
                        <th scope="col">Produk</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total = 0;
                    while ($d = mysqli_fetch_assoc($data)) {
                        $subtotal = $d['harga'] * $d['jumlah'];
                        $total += $subtotal;
                        ?>
                        <tr>
                            <td><?php echo $d['nama_produk']; ?></td>
                            <td><?php echo $d['harga']; ?></td>
                            <td><?php echo $d['jumlah']; ?></td>
                            <td><?php echo $subtotal; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
                <h3>Total: Rp <?php echo number_format($total) ?> </h3>
                <a href="checkout.php" class="btn custom-btn">Checkout</a>
            </table>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>