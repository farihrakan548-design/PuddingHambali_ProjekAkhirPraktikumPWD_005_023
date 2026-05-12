<?php include 'koneksi.php'; ?>

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

    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Puding Hambali</a>
            <div>
                <a href="user/keranjang.php" class="nav-link">Keranjang</a>
                <a href="about_us.php" class="nav-link">About Us</a>
                <?php if (isset($_SESSION['pengguna'])) { ?>
                    <a href="profil.php" class="nav-link">Profil</a>
                    <a href="logout.php" class="nav-link">Logout</a>
                <?php } else { ?>
                    <a href="login.php" class="nav-link">Login</a>
                    <a href="register.php" class="nav-link">Register</a>
                <?php } ?>
            </div>
        </div>
    </nav>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>