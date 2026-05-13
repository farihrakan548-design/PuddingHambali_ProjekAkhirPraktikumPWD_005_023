<?php
include 'koneksi.php';

if (!isset($_SESSION['pengguna'])) {
    header("Location: login.php");
    exit;
}

$id_pengguna = $_SESSION['pengguna']['id_pengguna'];

/* Ambil semua riwayat pesanan user */
$pesanan = mysqli_query($conn, "
    SELECT 
        pesanan.*,
        metode_pembayaran.nama_metode,
        metode_pembayaran.jenis
    FROM pesanan
    LEFT JOIN metode_pembayaran 
        ON pesanan.id_metode = metode_pembayaran.id_metode
    WHERE pesanan.id_pengguna = '$id_pengguna'
    ORDER BY pesanan.id_pesanan DESC
");
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pembayaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark custom-navbar">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.php">Pudding Hambali</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="keranjang.php">Keranjang</a></li>
                    <li class="nav-item"><a class="nav-link" href="profil.php">Profil</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                    <?php if (isset($_SESSION['pengguna']) && $_SESSION['pengguna']['role'] == 'admin') { ?>
                        <li class="nav-item"><a class="nav-link" href="dashboard_admin.php">Admin</a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        <div class="card shadow-lg border-0 rounded-4 p-4">
            <h2 class="section-title text-center mb-4">Riwayat Pesanan</h2>

            <?php if (mysqli_num_rows($pesanan) > 0) { ?>

                <div class="table-responsive">
                    <table class="table">
                        <thead class="table-warning">
                            <tr>
                                <th>ID Pesanan</th>
                                <th>Total Harga</th>
                                <th>Alamat Pengiriman</th>
                                <th>Metode Pembayaran</th>
                                <th>Catatan</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($p = mysqli_fetch_assoc($pesanan)) { ?>
                                <tr>
                                    <td>#<?php echo $p['id_pesanan']; ?></td>
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
                                    <td>
                                        <span class="badge bg-success">
                                            <?php echo $p['status'] ?? 'Diproses'; ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

            <?php } else { ?>

                <div class="alert alert-warning text-center section-title">
                    Anda belum memiliki riwayat pesanan.
                </div>

            <?php } ?>

            <div class="d-flex justify-content-end mt-4">
                <a type="button" class="btn custom-btn bg-dark" href="index.php">Kembali ke beranda</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>