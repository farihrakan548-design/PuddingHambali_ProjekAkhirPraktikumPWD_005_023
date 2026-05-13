<?php include 'koneksi.php';

if (!isset($_SESSION['pengguna'])) {
    header("location: login.php");
    exit;
}

$id_pengguna = $_SESSION['pengguna']['id_pengguna'];
$items = mysqli_query($conn, "SELECT keranjang.*, produk.harga FROM keranjang JOIN produk ON keranjang.id_produk=produk.id_produk WHERE keranjang.id_pengguna='$id_pengguna';");

$total = 0;
$itemData = [];

while ($i = mysqli_fetch_assoc($items)) {
    $itemData[] = $i;
    $total += $i['harga'] * $i['jumlah'];
}

if (isset($_POST['checkout'])) {
    $alamat = $_POST['alamat'];
    $metode = $_POST['metode'];
    $catatan = $_POST['catatan'];
}

$totalAkhir = $total;

mysqli_query($conn, "INSERT INTO pesanan(id_pengguna, total_harga, alamat_pengiriman, metode_pembayaran, catatan) VALUES('$id_pengguna','$totalAkhir','$alamat','$metode','$catatan');");
$id_pesanan = mysqli_insert_id($conn);

foreach ($itemData as $item) {

    $subtotal = $item['harga'] * $item['jumlah'];

    mysqli_query($conn, "INSERT INTO detail_pesanan(id_pesanan,id_produk,jumlah,subtotal) VALUES('$id_pesanan','{$item[$id_produk]}','{$item['jumlah']}','$subtotal');");

    mysqli_query($conn, "UPDATE produk SET stok = stok - {$item['jumlah']} WHERE id_produk='{$item['id_produk']}';");
}

mysqli_query($conn, "DELETE FROM keranjang WHERE id_user='$id_user';");

echo "Pesanan berhasil dibuat";

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

    <form method="POST">
        <textarea name="alamat" required></textarea>
        <select name="metode">
            <option>Transfer Bank</option>
            <option>E-Wallet</option>
            <option>COD</option>
        </select>
        <input type="text" name="voucher" placeholder="Kode Voucher">
        <textarea name="catatan"></textarea>
        <button type="submit" name="checkout">Checkout Sekarang</button>
    </form>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>