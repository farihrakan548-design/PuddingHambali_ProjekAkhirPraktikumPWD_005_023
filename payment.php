<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Payment - PuddingKu</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark custom-navbar">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">🍮 PuddingKu</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="index.html">Products</a></li>
                <li class="nav-item"><a class="nav-link active" href="payment.html">Payment</a></li>
                <li class="nav-item"><a class="nav-link" href="#">About Us</a></li>
                <li class="nav-item"><a class="nav-link" href="login.html">Login</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Register</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- PAYMENT -->
<div class="container py-5">

    <h2 class="text-center section-title mb-5">Payment Method</h2>

    <div class="row g-4">

        <!-- E-WALLET -->
        <div class="col-md-6">
            <div class="payment-card">

                <h3 class="payment-title">💳 E-Wallet</h3>

                <div class="payment-item">
                    <h5>DANA</h5>
                    <p>0895-1234-5678</p>
                </div>

                <div class="payment-item">
                    <h5>OVO</h5>
                    <p>0895-8765-4321</p>
                </div>

                <div class="payment-item">
                    <h5>GoPay</h5>
                    <p>0895-2222-1111</p>
                </div>

            </div>
        </div>

        <!-- BANK -->
        <div class="col-md-6">
            <div class="payment-card">

                <h3 class="payment-title">🏦 Bank Transfer</h3>

                <div class="payment-item">
                    <h5>Bank BCA</h5>
                    <p>1234567890</p>
                    <small>a.n PuddingKu</small>
                </div>

                <div class="payment-item">
                    <h5>Bank BRI</h5>
                    <p>9876543210</p>
                    <small>a.n PuddingKu</small>
                </div>

                <div class="payment-item">
                    <h5>Bank Mandiri</h5>
                    <p>1122334455</p>
                    <small>a.n PuddingKu</small>
                </div>

            </div>
        </div>

    </div>

</div>

<!-- FOOTER -->
<footer class="custom-footer text-center p-3">
    <p>&copy; 2026 PuddingKu | All Rights Reserved</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>