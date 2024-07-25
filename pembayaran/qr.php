<?php
session_start();
include '../database/db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pembayaran</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/feather-icons"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/pembayaran.css">
</head>
<body>
    <!-- Navbar Start -->
    <nav class="navbar">
        <a href="#" class="navbar-logo">Catering<span>ku</span>.</a>
    </nav>
    <!-- Navbar End -->

    <!-- Pembayaran Section Start -->
    <section class="pembayaran">
        <h1>Pembayaran</h1>

        <?php if(isset($_SESSION['dana'])) :?>
        <div class="payment-option">
            <h2>DANA</h2>
            <a href="https://link.dana.id/qr/16371e7i">
                <img src="../img/asset/pembayaran/qr.jpg" alt="Qris">
            </a>
            <p>Scan QR ini menggunakan aplikasi DANA</p>
        </div>

        <?php elseif(isset($_SESSION['gopay'])): ?>
        <div class="payment-option">
            <h2>GOPAY</h2>
            <a href="">
                <img src="../img/pembayaran/gopay.jpg" alt="Gopay QR">
            </a>
            <p>Scan QR ini menggunakan aplikasi Gojek</p>
        </div>

        <?php elseif(isset($_SESSION['ovo'])) :?>
        <div class="payment-option">
            <h2>OVO</h2>
            <a href="">
                <img src="img/asset/ovo-qr.jpg" alt="OVO QR">
            </a>
            <p>Scan QR ini menggunakan aplikasi OVO</p>
        </div>

        <?php else : ?>
        <div class="payment-option">
            <h2>Bitcoin</h2>
            <a href="https://link.dana.id/qr/16371e7i">
                <img src="../img/asset/pembayaran/btc.jpg" alt="Bitcoin QR">
            </a>
            <p>Scan QR ini menggunakan aplikasi Crypto Currency wallet</p>
        </div>
        <?php endif; ?>

        <form action="proses.php" method="post" enctype="multipart/form-data" class="upload-form">
            <label for="bukti">Masukkan bukti pembayaran</label>
            <input type="file" name="bukti" id="bukti" required>
            <button name="cek" type="submit">Next</button>
        </form>
    </section>
    <!-- Pembayaran Section End -->

    <script>
        feather.replace();
    </script>
    <script src="js/script.js"></script>
</body>
</html>
