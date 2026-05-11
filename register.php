<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register - Pudding Hambali</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark custom-navbar">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">🍮 Pudding Hambali</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="index.php">Products</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Payment</a></li>
                <li class="nav-item"><a class="nav-link" href="#">About Us</a></li>
                <li class="nav-item"><a class="nav-link active" href="login.php">Login</a></li>
                <li class="nav-item"><a class="nav-link" href="register.php">Register</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="login-box">

        <h2 class="text-center mb-4">Register Account</h2>

        <form>
            <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text" class="form-control" placeholder="Masukkan nama">
            </div>

            <div class="mb-3">
                <label class="form-label"> Daftar Email</label>
                <input type="email" class="form-control" placeholder="Masukkan email">
            </div>

            <div class="mb-3">
                <label class="form-label">Buat Password</label>
                <input type="password" class="form-control" placeholder="Masukkan password">
            </div>

            <div class="d-grid">
                <button type="submit" class="btn custom-btn">Register</button>
            </div>

            <p class="text-center mt-3">
                Sudah punya akun?
                <a href="login.php" class="register-link">Login</a>
            </p>

        </form>
    </div>
</div>

<footer class="custom-footer text-center p-3">
    <p>&copy; 2026 Pudding Hambali | All Rights Reserved</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>