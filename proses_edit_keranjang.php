<?php
include 'koneksi.php';

if (!isset($_SESSION['pengguna'])) {
    header("Location: login.php");
    exit;
}

$id_pengguna = $_SESSION['pengguna']['id_pengguna'];

/* Validasi parameter */
if (!isset($_GET['id']) || !isset($_GET['aksi'])) {
    header("Location: keranjang.php");
    exit;
}

$id_produk = $_GET['id'];
$aksi = $_GET['aksi'];

/* Tambah jumlah */
if ($aksi == 'tambah') {

    mysqli_query($conn, "
        UPDATE keranjang
        SET jumlah = jumlah + 1
        WHERE id_pengguna = '$id_pengguna'
        AND id_produk = '$id_produk'
    ");
}

/* Kurangi jumlah */
elseif ($aksi == 'kurang') {

    $cek = mysqli_query($conn, "
        SELECT jumlah
        FROM keranjang
        WHERE id_pengguna = '$id_pengguna'
        AND id_produk = '$id_produk'
    ");

    $data = mysqli_fetch_assoc($cek);

    if ($data['jumlah'] > 1) {

        mysqli_query($conn, "
            UPDATE keranjang
            SET jumlah = jumlah - 1
            WHERE id_pengguna = '$id_pengguna'
            AND id_produk = '$id_produk'
        ");

    } else {

        /* Jika jumlah tinggal 1, hapus produk */
        mysqli_query($conn, "
            DELETE FROM keranjang
            WHERE id_pengguna = '$id_pengguna'
            AND id_produk = '$id_produk'
        ");
    }
}

header("Location: keranjang.php#keranjang_anda");
exit;
?>