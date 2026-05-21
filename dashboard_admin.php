<?php

include 'koneksi.php';

if (!isset($_SESSION['pengguna'])) {
    header("Location: login.php");
    exit;
}

if ($_SESSION['pengguna']['role'] != 'admin') {
    echo "
    <script>
        alert('Akses ditolak! Khusus admin.');
        window.location.href='index.php';
    </script>";
    exit;
}

/* Buat ngupdate status pesanan */
if (isset($_POST['update_status'])) {

    $id_pesanan = $_POST['id_pesanan'];
    $status = $_POST['status'];

    mysqli_query($conn, "
        UPDATE pesanan
        SET status = '$status'
        WHERE id_pesanan = '$id_pesanan'
    ");

    header('location: dashboard_admin.php');
    exit;
}

if (isset($_POST['update_stok'])) {

    $id_produk = $_POST['id_produk'];
    $stok = $_POST['stok'];

    mysqli_query($conn, "
        UPDATE produk
        SET stok = '$stok'
        WHERE id_produk = '$id_produk'
    ");

    header("Location: dashboard_admin.php");
    exit;
}

/* Query buat ngambil data pesanan di database */
$pesanan = mysqli_query($conn, "
    SELECT 
        pesanan.*,
        pengguna.username,
        metode_pembayaran.nama_metode,
        metode_pembayaran.jenis
    FROM pesanan
    JOIN pengguna ON pesanan.id_pengguna = pengguna.id_pengguna
    LEFT JOIN metode_pembayaran 
        ON pesanan.id_metode = metode_pembayaran.id_metode
    ORDER BY pesanan.id_pesanan DESC
");

$produk = mysqli_query($conn, "
    SELECT * FROM produk
    ORDER BY id_produk DESC
");

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Pesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
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

    <div class="card shadow-lg border-0 rounded-4 p-4">
        <h2 class="section-title text-center mb-4">Tabel Pesanan</h2>

        <div class="table-responsive">
            <table class="table">
                <thead class="table-warning">
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Pesanan</th>
                        <th>Total</th>
                        <th>Alamat</th>
                        <th>Pembayaran</th>
                        <th>Catatan</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>

                    <?php while ($p = mysqli_fetch_assoc($pesanan)) { ?>

                        <tr>
                            <td>#<?php echo $p['id_pesanan']; ?></td>
                            <td><?php echo $p['username']; ?></td>
                            <td>
                                <?php
                                $id_pesanan = $p['id_pesanan'];
                                $items = mysqli_query($conn, "
                                    SELECT 
                                        produk.nama_produk,
                                        detail_pesanan.jumlah
                                    FROM detail_pesanan
                                    JOIN produk ON detail_pesanan.id_produk = produk.id_produk
                                    WHERE detail_pesanan.id_pesanan = '$id_pesanan'
                                ");

                                while ($item = mysqli_fetch_assoc($items)) {
                                    echo $item['nama_produk'] . " (x" . $item['jumlah'] . ")<br>";
                                    echo "<br>";
                                }
                                ?>
                            </td>
                            <td>Rp <?php echo number_format($p['total_harga']); ?></td>
                            <td><?php echo $p['alamat_pengiriman']; ?></td>
                            <td>
                                <?php echo $p['jenis']; ?> - <?php echo $p['nama_metode']; ?>
                            </td>
                            <td><?php echo $p['catatan'] ?: '-'; ?></td>
                            <td>
                                <?php
                                if (!empty($p['tanggal'])) {
                                    echo date('d-m-Y H:i', strtotime($p['tanggal']));
                                } else {
                                    echo '-';
                                }
                                ?>
                            </td>

                            <td class="text-center">
                                <span class="badge bg-success">
                                    <?php echo $p['status'] ?: 'Diproses'; ?>
                                </span>
                            </td>

                            <td>
                                <form method="POST">
                                    <input type="hidden" name="id_pesanan"
                                        value="<?php echo $p['id_pesanan']; ?>">

                                    <select name="status"
                                        class="form-select form-select-sm mb-2" required>

                                        <option value="Diproses"
                                            <?php if ($p['status'] == 'Diproses') echo 'selected'; ?>>
                                            Diproses
                                        </option>

                                        <option value="Dikirim"
                                            <?php if ($p['status'] == 'Dikirim') echo 'selected'; ?>>
                                            Dikirim
                                        </option>

                                        <option value="Selesai"
                                            <?php if ($p['status'] == 'Selesai') echo 'selected'; ?>>
                                            Selesai
                                        </option>

                                        <option value="Dibatalkan"
                                            <?php if ($p['status'] == 'Dibatalkan') echo 'selected'; ?>>
                                            Dibatalkan
                                        </option>

                                    </select>

                                    <button type="submit"
                                        name="update_status"
                                        class="btn custom-btn">
                                        Update
                                    </button>
                                </form>
                            </td>
                        </tr>

                    <?php } ?>

                </tbody>
            </table>
        
        </div>
        <div class="d-flex justify-content-center gap-2 mt-2">
                        <a href="index.php" type="button" class="btn custom-btn bg-dark">
                            Beranda
                        </a>
        </div>
    </div>
</div>
<div class="container py-5">

    <div class="card shadow-lg border-0 rounded-4 p-4">
        <h2 class="section-title text-center mb-4">Stok Produk</h2>

        <div class="table-responsive">
            <table class="table">
                <thead class="table-warning">
                    <tr>
                        <th>ID</th>
                        <th>Gambar</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Update</th>
                    </tr>
                </thead>
                <tbody>

                    <?php while ($p = mysqli_fetch_assoc($produk)) { ?>

                        <tr>
                            <td>#<?php echo $p['id_produk']; ?></td>
                            <td>
                                <img src="<?php echo $p['gambar']; ?>" width="80" class="rounded">
                            </td>
                            <td><?php echo $p['nama_produk']; ?></td>
                            <td>Rp <?php echo number_format($p['harga']); ?></td>
                            <td><?php if ($p['stok'] > 0){ ?>
                                <span class="badge bg-success">
                                    <?php echo $p['stok']; ?>
                                </span>
                             <?php } else { ?>
                                <span class="badge bg-danger">Habis</span>
                            <?php } ?></td>
                            <td>
                            <form method="POST" class="d-flex gap-2">
                                <input type="hidden"
                                       name="id_produk"
                                       value="<?php echo $p['id_produk']; ?>">
                                <input type="number"
                                       name="stok"
                                       class="form-control"
                                       value="<?php echo $p['stok']; ?>"
                                       min="0"
                                       required>
                                <button type="submit"
                                        name="update_stok"
                                        class="btn custom-btn">Update
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center gap-2 mt-2">
                        <a href="index.php" type="button" class="btn custom-btn bg-dark">Beranda</a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>