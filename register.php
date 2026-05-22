<?php

include 'koneksi.php';
if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = MD5($_POST['password']);
    $nama_lengkap = $_POST['nama_lengkap'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];

    mysqli_query($conn, "INSERT INTO pengguna(username,password,nama_lengkap,email,alamat)
    VALUES('$username','$password','$nama_lengkap','$email','$alamat');");

    header("location: login.php");
    exit;
}

?>


<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Register - Pudding Hambali</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
                        <h2 class="text-center fw-bold text-brown mb-4"> Register Account</h2>
                        <form method="POST">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Username</label>
                                <input type="text" class="form-control form-control-lg" name="username"
                                    placeholder="Masukkan username" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Password</label>
                                <input type="password" class="form-control form-control-lg" name="password"
                                    placeholder="Masukkan password" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Nama lengkap</label>
                                <input type="text" class="form-control form-control-lg" name="nama_lengkap"
                                    placeholder="Masukkan nama lengkap" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Email</label>
                                <input type="email" class="form-control form-control-lg" name="email"
                                    placeholder="Masukkan email" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Alamat</label>
                                <textarea class="form-control form-control-lg" name="alamat"
                                    placeholder="Masukkan alamat" required></textarea>
                            </div>
                            <div class="d-grid">
                                <button type="submit" name="register" class="btn btn-primary btn-lg">Register</button>
                            </div>
                        </form>
                        <p class="text-center mt-4 mb-0">Sudah punya akun?<a href="login.php"
                                class="text-decoration-none text-brown fw-bold"> Login</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="custom-footer text-center mt-5 p-4">
        <div class="container">
            <h5 class="fw-bold mb-2">Pudding Hambali</h5>
            <p class="mb-2">
                Puding premium dengan rasa terbaik untuk menemani setiap momen spesial Anda.
            </p>

            <p class="mb-1">📍 Yogyakarta, Indonesia</p>
            <p class="mb-1">📞 +62 812-1544-2566</p>
            <p class="mb-3">📧 info@puddinghambali.com</p>

            <small>&copy; 2026 Pudding Hambali Termoney-money 😹 | All Rights Reserved</small>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>