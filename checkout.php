<?php
include 'koneksi.php';

if (!isset($_SESSION['pengguna'])) {
    header("Location: login.php");
    exit;
}

$id_pengguna = $_SESSION['pengguna']['id_pengguna'];

/* Ambil data keranjang + detail produk */
$items = mysqli_query($conn, "
    SELECT keranjang.*, produk.nama_produk, produk.harga, produk.gambar
    FROM keranjang
    JOIN produk ON keranjang.id_produk = produk.id_produk
    WHERE keranjang.id_pengguna = '$id_pengguna'
");

/* Ambil metode pembayaran aktif */
$metodePembayaran = mysqli_query($conn, "
    SELECT * FROM metode_pembayaran 
    WHERE status='aktif'
");

$total = 0;
$itemData = [];

/* Hitung total */
while ($i = mysqli_fetch_assoc($items)) {
    $itemData[] = $i;
    $total += $i['harga'] * $i['jumlah'];
}

/* Proses checkout */
if (isset($_POST['checkout'])) {

    $alamat = $_POST['alamat'];
    $id_metode = $_POST['metode_pembayaran'];
    $catatan = $_POST['catatan'];

    $totalAkhir = $total;

    /* Simpan pesanan utama */
    mysqli_query($conn, "
        INSERT INTO pesanan(
            id_pengguna,
            total_harga,
            alamat_pengiriman,
            id_metode,
            catatan
        ) VALUES(
            '$id_pengguna',
            '$totalAkhir',
            '$alamat',
            '$id_metode',
            '$catatan'
        )
    ");

    $id_pesanan = mysqli_insert_id($conn);

    /* Simpan detail pesanan + kurangi stok */
    foreach ($itemData as $item) {

        $subtotal = $item['harga'] * $item['jumlah'];

        mysqli_query($conn, "
            INSERT INTO detail_pesanan(
                id_pesanan,
                id_produk,
                jumlah,
                subtotal
            ) VALUES(
                '$id_pesanan',
                '{$item['id_produk']}',
                '{$item['jumlah']}',
                '$subtotal'
            )
        ");

        mysqli_query($conn, "
            UPDATE produk
            SET stok = stok - {$item['jumlah']}
            WHERE id_produk = '{$item['id_produk']}'
        ");
    }

    /* Kosongkan keranjang */
    mysqli_query($conn, "
        DELETE FROM keranjang
        WHERE id_pengguna = '$id_pengguna'
    ");

    echo "
    <script>
        alert('Pesanan berhasil dibuat!');
        window.location.href='riwayat_pesanan.php';
    </script>";
    exit;
}
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

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card border-0 shadow-lg rounded-4">
                    <div class="card-body p-5">
                        <h2 class="section-title mb-4 text-center">Checkout</h2>
                        <form method="POST">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Alamat Pengiriman</label>
                                <textarea class="form-control form-control-lg" name="alamat"
                                    placeholder="Masukkan alamat" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Metode Pembayaran</label>
                                <select name="metode_pembayaran" class="form-control form-control-lg"
                                    aria-placeholder="Pilih metode pembayaran" required>
                                    <?php while ($m = mysqli_fetch_assoc($metodePembayaran)) { ?>
                                        <option value="<?php echo $m['id_metode']; ?>">
                                            <?php echo $m['jenis']; ?> - <?php echo $m['nama_metode']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Catatan untuk penjual</label>
                                <textarea class="form-control form-control-lg" name="catatan"
                                    placeholder="Masukkan catatan jika perlu"></textarea>
                            </div>
                            <div class="d-flex justify-content-center gap-2">
                                <button type="submit" name="checkout" class="btn custom-btn">Checkout</button>
                                <button type="button" class="btn custom-btn bg-dark"
                                    onclick="window.history.back()">Kembali</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>