<?php
include 'koneksi.php';

if (!isset($_SESSION['pengguna'])) {
    header("Location: login.php");
    exit;
}

$id_pengguna = $_SESSION['pengguna']['id_pengguna'];
$id_produk = $_GET['id'];

mysqli_query($conn, "DELETE FROM keranjang WHERE id_pengguna='$id_pengguna'");

mysqli_query($conn, "INSERT INTO keranjang (id_pengguna, id_produk, jumlah)
VALUES ('$id_pengguna', '$id_produk', 1)");

header("Location: checkout.php");
exit;
?>