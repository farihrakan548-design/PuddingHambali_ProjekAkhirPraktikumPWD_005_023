<?php
$conn = mysqli_connect("localhost","root","","puding_hambali");
if(!$conn){
    die("Koneksi gagal: " . mysqli_connect_error());
}
session_start();
?>