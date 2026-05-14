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
        metode_pembayaran.jenis,
        metode_pembayaran.nomor_tujuan
    FROM pesanan
    LEFT JOIN metode_pembayaran 
        ON pesanan.id_metode = metode_pembayaran.id_metode
    WHERE pesanan.id_pengguna = '$id_pengguna'
    ORDER BY pesanan.id_pesanan DESC;
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
                    <li class="nav-item"><a class="nav-link" href="about_us.php">About Us</a></li>
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

        <h2 class="section-title text-center mb-4">Pesanan Anda</h2>

        <?php if (mysqli_num_rows($pesanan) > 0) { ?>


            <?php while ($p = mysqli_fetch_assoc($pesanan)) { ?>
                <div class="card shadow-lg border-0 rounded-4 p-2 mb-4">
                    <div class="card-body">
                        <h4 class="section-title">ID Pesanan #<?php echo $p['id_pesanan']; ?></h4>
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-borderless">
                                    <tr>
                                        <th>Total Harga</th>
                                        <th>: </th>
                                        <td>Rp <?php echo number_format($p['total_harga']); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Alamat Pengiriman</th>
                                        <th>: </th>
                                        <td><?php echo $p['alamat_pengiriman']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Metode Pembayaran</th>
                                        <th>: </th>
                                        <td>
                                            <?php echo $p['jenis']; ?> - <?php echo $p['nama_metode']; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Nomor Tujuan</th>
                                        <th>: </th>
                                        <td><?php echo $p['nomor_tujuan']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Catatan Anda</th>
                                        <th>: </th>
                                        <td><?php echo $p['catatan'] ?: '-'; ?></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6 text-end">
                                <div>
                                    <span class="badge bg-success">
                                        <?php echo $p['status'] ?? 'Diproses'; ?>
                                    </span>
                                </div>
                                <div>
                                    <?php
                                    if (!empty($p['tanggal'])) {
                                        echo date('d-m-Y H:i', strtotime($p['tanggal']));
                                    } else {
                                        echo '-';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <?php if ($p['status'] == 'Diproses') { ?>
                            <p class="section-title">Catatan: Mohon untuk melakukan pembayaran sesuai dengan metode yang dipilih
                                pada saat
                                pesanan diproses</p>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>



        <?php } else { ?>

            <div class="alert alert-warning text-center section-title">
                Anda belum memiliki riwayat pesanan.
            </div>

        <?php } ?>

        <div class="d-flex justify-content-center mt-4">
            <a type="button" class="btn custom-btn bg-dark" href="index.php">Kembali ke beranda</a>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>