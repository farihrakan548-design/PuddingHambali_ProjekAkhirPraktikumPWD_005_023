<?php
include 'koneksi.php';

if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = MD5($_POST['password']);

    $query = mysqli_query($conn, "SELECT * FROM pengguna WHERE username='$username' AND password='$password';");

    if (mysqli_num_rows($query) > 0) {
        $pengguna = mysqli_fetch_assoc($query);
        $_SESSION['pengguna'] = $pengguna;

        if ($pengguna['role'] == 'admin') {
            header("dasboard_admin.php");
        } else {
            header("index.php");
        }
    } else {
        echo "Login gagal rek, keknya ada yang salah.";
    }
}
?>


<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Pudding Hambali</title>
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
                        <li class="nav-item"><a class="nav-link" href="user/keranjang.php">Keranjang</a></li>
                        <li class="nav-item"><a class="nav-link" href="profil.php">Profil</a></li>
                        <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                    <?php } else { ?>
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
                        <h2 class="text-center fw-bold text-brown mb-4"> Login Account</h2>
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
                            <div class="d-grid">
                                <button type="button" class="btn btn-primary btn-lg">Login</button>
                            </div>
                        </form>
                        <p class="text-center mt-4 mb-0">Belum punya akun?<a href="register.php"
                                class="text-decoration-none text-brown fw-bold"> Register</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="custom-footer text-center mt-5 p-3">
        <p>&copy; 2026 Pudding Hambali Termoney money 😹 | All Rights Reserved</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>