<?php 
include 'koneksi.php';

if (!isset($_SESSION['pengguna'])) {
    header("Location: login.php");
    exit;
}

$id_pengguna = $_SESSION['pengguna']['id_pengguna'];

/* jika user ingin membatalkan pesanan */
if (isset($_GET['batal'])) {
    $id_pesanan = $_GET['batal'];

    /* Cek apakah pesanan masih dalam status Diproses dan milik user yang sedang login */
    mysqli_query($conn, "
            UPDATE pesanan
            SET status = 'Dibatalkan'
            WHERE id_pesanan = '$id_pesanan'
            AND id_pengguna = '$id_pengguna'
        ");

    header('location: riwayat_pesanan.php');
    exit;
}

/* jika user ingin membeli lagi  */
if (isset($_GET['beli_lagi'])) {
    $id_pesanan = $_GET['beli_lagi'];

    /* Cek apakah pesanan masih dalam status Diproses dan milik user yang sedang login */
    mysqli_query($conn, "
            UPDATE pesanan
            SET status = 'Diproses'
            WHERE id_pesanan = '$id_pesanan'
            AND id_pengguna = '$id_pengguna'
        ");

    header('location: riwayat_pesanan.php');
    exit;
}
?>