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

if (isset($_POST['update_produk'])) {

    $id_produk = $_POST['id_produk'];
    $gambar = $_POST['gambar'];
    $nama_produk = $_POST['nama_produk'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    mysqli_query($conn, "
        UPDATE produk
        SET gambar = '$gambar', nama_produk = '$nama_produk', harga = '$harga', stok = '$stok'
        WHERE id_produk = '$id_produk'
    ");

    header("Location: dashboard_admin.php#produk");
    exit;
}

if (isset($_POST['hapus_produk'])) {
    $id_produk = $_POST['id_produk'];

    mysqli_query($conn, "
        DELETE FROM produk
        WHERE id_produk = '$id_produk'
    ");

    header("Location: dashboard_admin.php#produk");
    exit;
}

if (isset($_POST['tambah_produk'])) {
    $gambar = $_POST['gambar'];
    $nama_produk = $_POST['nama_produk'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    mysqli_query($conn, "
        INSERT INTO produk (gambar, nama_produk, harga, stok)
        VALUES ('$gambar', '$nama_produk', '$harga', '$stok')
    ");

    header("Location: dashboard_admin.php#produk");
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


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
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

    <div class="row mt-5"></div>
    <div class="container py-5 mt-5">
        <div class="card shadow-lg border-0 rounded-4 p-4">
            <h2 class="section-title text-center mb-4">Tabel Pesanan</h2>

            <table class="table-responsive mb-4">
                <?php

                /* Buat nampilin total pendapatan, jumlah pesanan, dan total penjualan di dashboard admin */

                $total_pendapatan = mysqli_query($conn, "
                SELECT SUM(total_harga) AS total
                FROM pesanan
                WHERE status = 'Selesai'
            ");
                $total_pendapatan = mysqli_fetch_assoc($total_pendapatan)['total'];
                ?>
                <tr>
                    <th>Total Pendapatan Rp <?php echo number_format($total_pendapatan); ?></th>
                </tr>
                <?php $jumlah_pesanan = mysqli_query($conn, "
                SELECT COUNT(*) AS total
                FROM pesanan
                WHERE status = 'Selesai'
            ");
                $jumlah_pesanan = mysqli_fetch_assoc($jumlah_pesanan)['total'];
                ?>
                <tr>
                    <th>Jumlah Pesanan -> <?php echo $jumlah_pesanan; ?></th>
                </tr>

                <?php $total_penjualan = mysqli_query($conn, "
                SELECT SUM(jumlah) AS total
                FROM detail_pesanan
                JOIN pesanan ON detail_pesanan.id_pesanan = pesanan.id_pesanan
                WHERE pesanan.status = 'Selesai'
            ");
                $total_penjualan = mysqli_fetch_assoc($total_penjualan)['total'];
                ?>
                <tr>
                    <th>Total Penjualan -> <?php echo $total_penjualan; ?> pack</th>
                </tr>
            </table>
            </table>

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
                                    <?php if ($p['status'] == 'Dibatalkan') { ?>
                                        <span class="badge bg-danger">
                                            <?php echo $p['status']; ?>
                                        </span>
                                    <?php } else if ($p['status'] == 'Dikirim') { ?>
                                            <span class="badge bg-primary">
                                            <?php echo $p['status']; ?>
                                            </span>
                                    <?php } else if ($p['status'] == 'Selesai') { ?>
                                                <span class="badge bg-success">
                                            <?php echo $p['status']; ?>
                                                </span>
                                    <?php } else { ?>
                                                <span class="badge bg-warning">
                                            <?php echo $p['status'] ?: 'Diproses'; ?>
                                                </span>
                                    <?php } ?>
                                </td>

                                <td>
                                    <form method="POST">
                                        <input type="hidden" name="id_pesanan" value="<?php echo $p['id_pesanan']; ?>">

                                        <select name="status" class="form-select form-select-sm mb-2" required>

                                            <option value="Diproses" <?php if ($p['status'] == 'Diproses')
                                                echo 'selected'; ?>>
                                                Diproses
                                            </option>

                                            <option value="Dikirim" <?php if ($p['status'] == 'Dikirim')
                                                echo 'selected'; ?>>
                                                Dikirim
                                            </option>

                                            <option value="Selesai" <?php if ($p['status'] == 'Selesai')
                                                echo 'selected'; ?>>
                                                Selesai
                                            </option>

                                            <option value="Dibatalkan" <?php if ($p['status'] == 'Dibatalkan')
                                                echo 'selected'; ?>>
                                                Dibatalkan
                                            </option>

                                        </select>
                                        <button type="submit" name="update_status" class="btn custom-btn"
                                            onclick="return confirm('Update status pesanan?')">
                                            Update
                                        </button>
                                    </form>
                                </td>
                            </tr>

                        <?php } ?>

                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <div class="container py-5">

        <div class="card shadow-lg border-0 rounded-4 p-4" id="produk">
            <h2 class="section-title text-center mb-4">Produk</h2>

            <div class="table-responsive">
                <table class="table">
                    <thead class="table-warning">
                        <tr>
                            <th>ID</th>
                            <th>Gambar</th>
                            <th>Url Gambar</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php while ($p = mysqli_fetch_assoc($produk)) { ?>

                            <tr>
                                <form method="POST" class="d-flex gap-2">
                                    <td>
                                        #<?php echo $p['id_produk']; ?></td>
                                    <td>
                                        <img src="<?php echo $p['gambar']; ?>" width="80" class="rounded">
                                    </td>
                                    <td>
                                        <input type="text" name="gambar" class="form-control"
                                            value="<?php echo $p['gambar']; ?>" required>
                                    </td>
                                    <td>
                                        <input type="text" name="nama_produk" class="form-control"
                                            value="<?php echo $p['nama_produk']; ?>" required>
                                    </td>
                                    <td>
                                        <input type="number" name="harga" class="form-control"
                                            value="<?php echo $p['harga']; ?>" min="0" required>
                                    </td>
                                    <td>
                                        <input type="number" name="stok" class="form-control"
                                            value="<?php echo $p['stok']; ?>" min="0" required>
                                    </td>
                                    <td class="d-flex flex-column gap-2">
                                        <input type="hidden" name="id_produk" value="<?php echo $p['id_produk']; ?>">
                                        <button type="submit" name="update_produk" class="btn custom-btn"
                                            onclick="return confirm('update data produk?')">Update
                                        </button>
                                        <button type="submit" name="hapus_produk" class="btn btn-warning"
                                            onclick="return confirm('Yakin ingin menghapus produk ini?')">Hapus
                                        </button>
                                    </td>
                                </form>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="container py-5 mb-5">

        <div class="card shadow-lg border-0 rounded-4 p-4">
            <h2 class="section-title text-center mb-4">Tambah Produk Baru</h2>

            <form method="POST" class="row g-3">

                <div class="col-md-6">
                    <label class="form-label">Url Gambar</label>
                    <input type="text" name="gambar" class="form-control" placeholder="Masukkan url gambar produk"
                        required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Nama Produk</label>
                    <input type="text" name="nama_produk" class="form-control" placeholder="Masukkan nama produk"
                        required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Harga</label>
                    <input type="number" name="harga" class="form-control" placeholder="Masukkan harga produk" min="0"
                        required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Stok</label>
                    <input type="number" name="stok" class="form-control" placeholder="Masukkan stok produk" min="0"
                        required>
                </div>
                <div class="col-12 justify-content-center d-flex">
                    <button type="submit" name="tambah_produk" class="btn custom-btn"
                        onclick="return confirm('Yakin ingin menambahkan produk ini?')">Tambah Produk</button>
                </div>
            </form>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>