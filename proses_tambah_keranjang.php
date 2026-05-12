<?php

include 'koneksi.php';
if (!isset($_SESSION['pengguna'])){
    header("location: login.php");
    exit;
}

$id_pengguna = $_SESSION['pengguna']['id_pengguna'];
$id_produk = $_GET['id'];

$ngecek_keranjang = mysqli_query($conn, "SELECT * FROM keranjang WHERE id_pengguna='$id_pengguna' AND id_produk='$id_produk';");

if (mysqli_num_rows($ngecek_keranjang) > 0) {
    mysqli_query($conn, "UPDATE keranjang SET jumlah=jumlah+1 WHERE id_pengguna='$id_pengguna' AND id_produk='$id_produk';");
} else {
    mysqli_query($conn, "INSERT INTO keranjang(id_pengguna, id_produk, jumlah) VALUES('$id_pengguna','$id_produk',1);");
}

header("location: index.php#produk");
exit;
?>