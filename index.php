<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pudding Hambali</title>

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
                <li class="nav-item"><a class="nav-link" href="#products">Products</a></li>
                <li class="nav-item"><a class="nav-link" href="payment.php">Payment</a></li>
                <li class="nav-item"><a class="nav-link" href="aboutus.php">About Us</a></li>
                <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                <li class="nav-item"><a class="nav-link" href="register.php">Register</a></li>
            </ul>
        </div>
    </div>
</nav>

<section class="header">
    <div class="container text-center">
        <h1 class="display-4 section-title">Welcome to Pudding Hambali</h1>
        <p class="lead">Pudding lezat aseli ngawi. ownernya Pak Hambali</p>
    </div>
</section>

<div class="container mt-5" id="products">
    <h2 class="text-center mb-4 section-title">Pudding Kita</h2>
    <div class="row g-4">
    
        <div class="col-md-3">
            <div class="card custom-card">
                <img src="PuddingHambali_ProjekAkhirPraktikumPWD_005_023/images/puddingcoklat.jpg" class="card-img-top">
                <div class="card-body text-center">
                    <h5>Pudding Coklat</h5>
                    <p>Manis dan lembut.</p>
                    <button type="button" class="btn btn-primary w-100">Beli</button>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card custom-card">
                <img src="PuddingHambali_ProjekAkhirPraktikumPWD_005_023/images/puddingcaramel.jpg" class="card-img-top">
                <div class="card-body text-center">
                    <h5>Pudding Caramel</h5>
                    <p>Manis dan Gurih.</p>
                    <button type="button" class="btn btn-primary w-100">Beli</button>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card custom-card">
                <img src="PuddingHambali_ProjekAkhirPraktikumPWD_005_023/images/puddingmangga.jpg" class="card-img-top">
                <div class="card-body text-center">
                    <h5>Pudding Mangga</h5>
                    <p>Manis alami.</p>
                    <button type="button" class="btn btn-primary w-100">Beli</button>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card custom-card">
                <img src="PuddingHambali_ProjekAkhirPraktikumPWD_005_023/images/puddingvanilla.jpg" class="card-img-top">
                <div class="card-body text-center">
                    <h5>Pudding Vanilla</h5>
                    <p>Rasa klasik.</p>
                    <button type="button" class="btn btn-primary w-100">Beli</button>
                </div>
            </div>
        </div>

    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

<footer class="custom-footer text-center mt-5 p-3">
    <p>&copy; 2026 Pudding Hambali | All Rights Reserved</p>
</footer>

</html>