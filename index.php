<?php

include 'database/db.php';

$produk=mysqli_query($conn,"SELECT * FROM tbl_product");



?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tracker Coffee</title>

    <!-- Fonts -->
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,700;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Feather Icons -->
    <script src="https://unpkg.com/feather-icons"></script>

    <!-- My CSS Style -->
    <link rel="stylesheet" href="style.css" />
  </head>

  <body>
    <!-- Navbar Start-->
    <nav class="navbar">
      <a href="index.html" class="navbar-logo">Tracker<span>coffee</span>.</a>
      <div class="navbar-nav">
        <a href="#home">Home</a>
        <a href="#about">Tentang Kami</a>
        <a href="#menu">Menu</a>
        <a href="#contact">Contact</a>

        <!-- Login Navbar For Mobile -->
        <a href="login/login.php" class="nav login" id="login">Log-in / Sign-up</a>
      </div>

      <div class="navbar-extra">
        <a href="#" id="search"> <i data-feather="search"></i></a>
        <a href="#" id="shopping-cart"> <i data-feather="shopping-cart"></i></a>
        <a href="#" id="hamburger-menu"> <i data-feather="menu"></i></a>

        <!-- Login Navbar -->
        <a href="login/login.php" class="login" id="user login">Log-in / Sign-up</a>
      </div>
    </nav>
    <!-- Navbar End-->

    <!-- Hero Section Start -->
    <section class="hero-section" id="home">
      <main class="content">
        <h1>Kenikmatan Secangkir <span>Kopi</span>.</h1>
        <p>Even bad coffee is better than no coffee at all. ~David Lynch</p>
        <a href="#menu" class="btn-beli">Beli Sekarang</a>
      </main>
    </section>
    <!-- Hero Section End-->

    <!-- About Section Start -->
    <section class="about" id="about">
      <h2><span>Tentang</span> Kami</h2>
      <div class="subjudul">
        <p>INI ADALAH MENGENAI CERITA DAN PERJALANAN KAMI</p>
      </div>

      <div class="row">
        <div class="about-img">
          <img src="img/coffe2bg.jpg" alt="" srcset="" />
        </div>
        <div class="content">
          <h3>Apa Itu Tracker Coffee?</h3>
          <p>
            Kami adalah perusahaan kopi yang mendedikasikan seluruh gairah,
            kecintaan, dan antusiasme kami kepada dunia kopi yang menakjubkan.
            Kami adalah perusahaan lokal dan sebagian besar bahan baku yang kami
            gunakan adalah lokal. Ya, dan kami mengatakan hal tersebut dengan
            bangga.
          </p>
          <p>
            Kami tahu, begitu juga Anda, bahwa biji-biji kopi terbaik dunia
            berasal dari Indonesia. Kami berkeliling ke berbagai pelosok
            Indonesia dan bekerja sama dengan para petani dan pemanggang kopi
            lokal untuk mendapatkan cite rasa kopi terbaik Indonesia, bijt kopi
            arabika grade satu dan berbagai perkebunan yang tersebar di
            Nusantara.
          </p>
          <p>
            Dengan pengalaman dan pengetahuan kami di industri kopi ritel, mulai
            dan pemWhan biji kopi sampai dengan bagaimana mendesain sebuah
            coffee bar, kami membuat perjalanan bisnis kopi Anda menjadi
            EASY,SIMPLE,dan FUN!
          </p>
        </div>
      </div>
    </section>
    <!-- About Section End -->

    <!-- Menu Section Start -->
    <section class="menu" id="menu">
      <h2><span>Coffee</span> Menu</h2>
      <p>MENU COFFEE DARI SELURUH PENJURU DUNIA. PILIH COFFE FAVORITMU!</p>

      <div class="row">

      <?php while($p=mysqli_fetch_object($produk)): ?>
        <div class="menu-card">
          <img
            class="menu-card-img"
            src="img/coffee-menu/<?php echo $p->product_image ?>"
            alt="Espresso" 
          />
          <h3 class="menu-card-title">~ <?php echo $p->product_name ?> ~</h3>
          <p class="menu-card-price">Rp.<?php echo $p->product_price ?></p>
          <a class="beli-menu" href="qr.html">Beli Sekarang</a>
        </div>

        <?php endwhile; ?>
      </div>
    </section>
    <!-- Menu Section End -->

    <!-- Contact Section Start -->
    <section class="contact" id="contact">
      <h2>Kontak <span>Kami</span></h2>
      <p>HUBUNGI KAMI JIKA ADA YANG INGIN DITANYAKAN</p>

      <div class="row">
        <iframe
          class="map"
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.597407767157!2d106.65815551409116!3d-6.184599362317558!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f91c36836213%3A0x6352737102ead164!2sGg.%20Annur%2C%20RW.001%2C%20Poris%20Plawad%20Utara%2C%20Kec.%20Cipondoh%2C%20Kota%20Tangerang%2C%20Banten%2015141!5e0!3m2!1sid!2sid!4v1675228682362!5m2!1sid!2sid"
          style="border: 0"
          allowfullscreen=""
          loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"
        ></iframe>

        <form action="" method="get">
          <div class="input-group">
            <i data-feather="user"></i>
            <input type="text" name="nama" id="nama" placeholder="nama" />
          </div>

          <div class="input-group">
            <i data-feather="mail"></i>
            <input type="email" name="email" id="email" placeholder="email" />
          </div>

          <div class="input-group">
            <i data-feather="phone"></i>
            <input type="text" name="phone" id="phone" placeholder="+62" />
          </div>

          <button type="submit">Kirim Pesan</button>
        </form>
      </div>
    </section>
    <!-- Contact Section End  -->

    <!-- Fotter Start -->
    <footer>
      <div class="sosial">
        <a target="_blank" href="https://twitter.com/MiftaAldi24?t=tGR24pLkyKmcJkHMb6NlwA&s=09"><i data-feather="twitter"></i></a>
        <a target="_blank" href="https://instagram.com/mifta_xh_ui?igshid=ZDdkNTZiNTM="><i data-feather="instagram"></i></a>
        <a target="_blank" href="https://github.com/Mifta24"><i data-feather="github"></i></a>
      </div>

      <div class="link">
        <a href="#home">Home</a>
        <a href="#about">Tentang Kami</a>
        <a href="#menu">Menu</a>
        <a href="#contact">Contact</a>
      </div>

      <div class="credit">
        <p>Created by <a href="">Miftahudin Aldi Saputra</a>| &copy; 2023.</p>
      </div>
    </footer>
    <!-- Fotter End -->

    <!-- Feather Icons -->
    <script>
      feather.replace();
    </script>

    <!-- My Javascript-->
    <script src="js/script.js"></script>
  </body>
</html>
