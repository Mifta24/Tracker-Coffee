<?php

include 'db.php';

$produk=mysqli_query($conn,"SELECT * FROM tbl_product WHERE product_id='".$_GET['id']."' ");

$p=mysqli_fetch_object($produk);

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
        <a href="index.php" class="nav login" id="navlogout">Log-Out</a>
      </div>

      <div class="navbar-extra">
        <a href="#" id="search"> <i data-feather="search"></i></a>
        <a href="#" id="shopping-cart"> <i data-feather="shopping-cart"></i></a>
        <a href="#" id="hamburger-menu"> <i data-feather="menu"></i></a>
        <a href="index.php" class="login" id="logout"><i data-feather="log-out"></i></a>
      </div>
    </nav>
    <!-- Navbar End-->

    
    <!-- Menu Section Start -->
    <section class="menu" id="menu">
      <h2><span>Coffee</span> Menu</h2>

      <div class="row">

     
        <div class="menu-card">
            
            <img
              class="menu-card-img"
              src="img/coffee-menu/<?php echo $p->product_image ?>"
              alt="Espresso"
            />
          <h3 class="menu-card-title">~ <?php echo $p->product_name ?> ~</h3>
          <p class="menu-card-price">Rp. <?php echo number_format( $p->product_price) ?></p>
          <p class=""><?php echo  $p->product_description ?></p>
          <p class="">Stock : <?php echo  $p->stock ?></p>
          <a class="beli-menu" href="qr.html">Beli Sekarang</a>
        </div>

      
      </div>
    </section>
    <!-- Menu Section End -->

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
