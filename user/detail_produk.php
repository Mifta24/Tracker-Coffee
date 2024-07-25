<?php

include '../database/db.php';

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
    <link rel="stylesheet" href="css/detail.css" />
  </head>

  <body>
    <!-- Navbar Start-->
    <nav class="navbar">
      <a href="user.php" class="navbar-logo">Tracker<span>coffee</span>.</a>
      <div class="navbar-nav">
      <a href="user.php #home">Home</a>
        <a href="user.php #about">Tentang Kami</a>
        <a href="user.php #menu">Menu</a>
        <a href="user.php #contact">Contact</a>
        <a href="../admin/logout.php" class="nav login" id="navlogout">Log-Out</a>
      </div>

      <div class="navbar-extra">
        <!-- <a href="#" id="search"> <i data-feather="search"></i></a> -->
        <a href="keranjang.php" id="shopping-cart"> <i data-feather="shopping-cart"></i></a>
        <a href="#" id="hamburger-menu"> <i data-feather="menu"></i></a>
        <a href="../admin/logout.php" class="login" id="logout"><i data-feather="log-out"></i></a>
      </div>
    </nav>
    <!-- Navbar End-->

    
    <!-- Menu Section Start -->
    <section class="menu" id="menu">
      
      <div class="row">
        
        
        <div class="menu-card">
          <h2 class="judul"><span>Coffee</span> Menu</h2>
            
            <img
              class="menu-card-img"
              src="../img/asset/menu/<?php echo $p->product_image ?>"
              alt="../img/asset/menu/<?php echo $p->product_image ?>"
            />
          <h3 class="menu-card-title">~ <?php echo $p->product_name ?> ~</h3>
          <p class=""><?php echo  $p->product_description ?></p>
          <a class="beli-menu" href="user.php #menu">Beli Sekarang</a>
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
        <a href="user.php #home">Home</a>
        <a href="user.php #about">Tentang Kami</a>
        <a href="user.php #menu">Menu</a>
        <a href="user.php #contact">Contact</a>
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
    <script src="../js/script.js"></script>
  </body>
</html>
