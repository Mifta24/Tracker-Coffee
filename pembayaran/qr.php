<?php

session_start();

include'../database/db.php';


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pembayaran</title>

    <link
    href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,700;1,700&display=swap"
    rel="stylesheet"
  />

  <!-- Feather Icons -->
  <script src="https://unpkg.com/feather-icons"></script>

 <!-- My Style -->
  <link rel="stylesheet" href="css/pembayaran.css">
</head>
<body>

    <!-- Navbar Start-->
    <nav class="navbar">
        <a href="index.html" class="navbar-logo">Tracker<span>coffee</span>.</a>
        <!-- <div class="navbar-nav">
          <a href="index.html#home">Home</a>
          <a href="index.html#about">Tentang Kami</a>
          <a href="index.html#menu">Menu</a>
          <a href="index.html#contact">Contact</a>
        </div>
  
        <div class="navbar-extra">
          <a href="#" id="search"> <i data-feather="search"></i></a>
          <a href="#" id="shopping-cart"> <i data-feather="shopping-cart"></i></a>
          <a href="#" id="hamburger-menu"> <i data-feather="menu"></i></a>
        </div> -->
      </nav>
      <!-- Navbar End-->


    <!-- pembayaran Section Start -->
    <section class="pembayaran" id="pembayaran">
        <h1>Pembayaran Coffee</h1>

        <?php if(isset($_SESSION['dana'])) :?>
        <!-- Dana -->
        <div class="qr">
            <h3>DANA</h3>
            <a href="https://link.dana.id/qr/16371e7i"><img src="../img/pembayaran/qr.jpg" alt="Qris"></a>
            <p class="qr-title">Scan QR ini menggunakan aplikasi DANA</p>
        </div>

        <?php elseif(isset($_SESSION['gopay'])): ?>
        <!-- gopay -->
        <div class="qr">
            <h3><?xml version="1.0" encoding="utf-8"?>
                <!-- Generator: Adobe Illustrator 22.0.0, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
                <svg height="4rem" width="300" version="1.0" id="Izolovaný_režim" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
                     y="0px" viewBox="0 0 1066.1 320.1" style="enable-background:new 0 0 1066.1 320.1;" xml:space="preserve">
                <style type="text/css">
                    .st0{fill:#1899D6;}
                    .st1{fill:#2F4049;}
                </style>
                <g>
                    <path class="st0" d="M701.7,244.3c-47,0-74.8-31.7-73.5-73c1.6-52.8,48.2-96.6,103.8-96.6c23.8,0,42.9,6.2,55.6,12.6l-7.4,39.1
                        c-15.9-8.6-29.5-13.8-51.6-13.8c-34.6,0-57.5,25.8-58.3,53.7c-0.7,22.2,12.7,40.6,38.5,40.6c5.8,0,12.6-0.9,17.2-2l10.1-53.4
                        l39.4,0l-15.3,80.6C743.5,239.8,721.5,244.3,701.7,244.3"/>
                    <polygon class="st0" points="901,151.5 822.5,104.7 801.8,214.2 	"/>
                    <path class="st1" d="M317.6,134.1c20.4,0,35.2,12,35.2,30.4c0,24-21.2,40.6-42.3,40.6c-20.4,0-35.2-11.9-35.2-30.4
                        C275.3,150.9,296.4,134.1,317.6,134.1 M310.9,186.2c9.1,0,18.9-7.8,18.9-20.2c0-8-5.3-12.9-12.4-12.9c-9,0-19,8.2-19,20.6
                        C298.3,181.6,303.6,186.2,310.9,186.2"/>
                    <path class="st1" d="M376.2,109.3h36c5.5,0,10.3,0.9,14.4,2.9c8.8,4.2,13.7,12.9,13.7,23.9c0,15.8-9,29.3-21.6,35.2
                        c-4.5,2.1-9.5,3.2-14.5,3.2h-17.5l-5.7,29.1h-23.1L376.2,109.3z M401.7,154.7c2.9,0,5.7-0.5,7.8-2c4.3-2.9,7.1-8.3,7.1-14.5
                        c0-5.5-3.2-9.1-9.5-9.1h-11.6l-5,25.6H401.7z"/>
                    <path class="st1" d="M483.2,161.2h0.9c0.1-0.9,0.3-2.1,0.3-2.5c0-4.5-3.2-6.2-8.6-6.2c-8.6,0-19.6,6.2-19.6,6.2l-4.9-17.1
                        c0,0,14-7.5,29-7.5c11.5,0,26.9,4.5,26.9,21.6c0,2-0.3,4.2-0.7,6.6l-7.9,41.3h-20.8l0.8-4.1c0.4-2.2,1.2-4.2,1.2-4.2h-0.3
                        c0,0-7.4,9.9-20,9.9c-10.1,0-19.9-6.1-19.9-17.5C439.6,167,465.8,161.2,483.2,161.2 M468,187.7c5.9,0,12.4-6.5,13.4-12l0.3-1.5
                        h-2.1c-4.9,0-17.1,1.1-17.1,9.1C462.5,185.8,464.2,187.7,468,187.7"/>
                    <path class="st1" d="M518.8,212.1c4,0,8.7-1.1,12.3-6.9l2-3.2l-15.9-66.6h23.7l5.5,33.6c0.7,3.7,0.7,10,0.7,10h0.3
                        c0,0,2.4-5.9,4.1-9.6l15.2-34h25.6l-42.4,75.1c-8.4,14.9-20.2,20.4-29.7,20.4c-10,0-17.8-5.3-17.8-5.3l9.9-15.8
                        C512.1,210,514.9,212.1,518.8,212.1"/>
                    <path class="st1" d="M223.7,205.6c-27.6,0-43.9-18.5-43.2-42.5c1-30.8,28.3-56.3,61-56.3c14,0,25.1,3.5,32.5,7.3l-4.3,22.8
                        c-9.3-5-17.3-8.1-30.2-8.1c-20.3,0-33.8,15.1-34.3,31.3c-0.4,12.9,7.4,23.7,22.6,23.7c3.4,0,7.4-0.5,10.1-1.2l5.9-31.1h23.1
                        l-8.9,47C248.2,203,235.3,205.6,223.7,205.6"/>
                </g>
                </svg>
                </h3>
            <a href=""><img src="../img/pembayaran/gopay.jpg" alt="Qris"></a>
            <p class="qr-title">Scan QR ini menggunakan aplikasi Gojek</p>
        </div>

        <?php elseif(isset($_SESSION['ovo'])) :?>
        <div class="qr">
            <h3 style=" text-align:center; justify-content:center; align-items:center; display: flex;"><img src="img/ovo-logo.jpeg" alt="" width="80px" height="40px"></h3>
            <a href=""><img src="img/ovo-qr.jpg" alt=""></a>
            <p class="qr-title">Scan Qris Ini menggunakan Aplikasi OVO</p>
        </div>

        <?php else : ?>
        <!-- btc -->
        <div class="qr">
            <h3>
                <?xml version="1.0" ?><svg height="1.5rem" viewBox="0 0 256 256" width="2rem" xmlns="http://www.w3.org/2000/svg"><defs><style>
                .cls-1 {
                  fill: #fab915;
                }
          
                .cls-2 {
                  fill: #fff;
                  fill-rule: evenodd;
                }
              </style></defs><g data-name="bitoin btc coin crypto" id="bitoin_btc_coin_crypto"><g data-name="bitoin btc" id="bitoin_btc"><circle class="cls-1" cx="128" cy="128" id="round" r="128"/><path class="cls-2" d="M321,432s21,10.447,21,32.733S326.138,503,303,503H292v7a4.875,4.875,0,0,1-5,5h-9a4.875,4.875,0,0,1-5-5v-7H263v7a4.875,4.875,0,0,1-5,5h-9a4.875,4.875,0,0,1-5-5v-7h-9a4.875,4.875,0,0,1-5-5v-6a4.875,4.875,0,0,1,5-5h9V388h-9a4.875,4.875,0,0,1-5-5v-5a4.875,4.875,0,0,1,5-5h9v-9a4.875,4.875,0,0,1,5-5h9a4.875,4.875,0,0,1,5,5v9h10v-9a4.875,4.875,0,0,1,5-5h9a4.875,4.875,0,0,1,5,5v9h9s34,1.552,34,33C335,429.029,321,432,321,432Zm-20-44H263v39h38s17-2.181,17-21C318,390.771,305.736,388.183,301,388Zm6,54H263v45h40s20.046-4.191,20.046-22.267S310.355,441.985,307,442Z" id="B" transform="translate(-152 -309)"/></g></g></svg>Bitcoin</h3>
            <a href="https://link.dana.id/qr/16371e7i"><img src="../img/pembayaran/btc.jpg" alt="Qris"></a>
            <p class="qr-title">Scan QR ini menggunakan aplikasi Crypto Curenncy wallet</p>
        </div>
        <?php endif; ?>

        <form action="proses.php" method="post" enctype="multipart/form-data">
            <label for="bukti">Masukkan bukti pembayaran</label>
            <input type="file" name="bukti" id="" required >

            <button name="cek" type="submit">Next</button>
        </form>

    </section>
    <!-- Pembayaran Section End -->

<!-- <p style="color: green;"></p> -->


    <script>
        feather.replace();
      </script>
  
      <!-- My Javascript-->
      <script src="js/script.js"></script>
</body>
</html>