<?php

session_start();
    include '../database/db.php';
    if ($_SESSION['status'] != "login") {
      header("location:../login/login.php?pesan=belum_login");
    }

    $id=$_GET['id'];

    $pembayaran = mysqli_query($conn, "SELECT * FROM tbl_pembayaran WHERE id=$id ");
    $row = mysqli_fetch_array($pembayaran)

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

    
    <!-- Menu Section Start -->
    <section class="menu" id="menu">
        <a class="close" href="penjualan.php">
            <i data-feather="x-circle"></i>
        </a>
      <div class="row">
        
        
        <div class="menu-card">
          <h2 class="judul"><span>Coffee</span> Menu</h2>
            
            <img
              class="menu-card-img"
              src="../img/bukti-pembayaran/<?php echo $row['bukti_pembayaran'] ?>"
              alt="../img/bukti-pembayaran/<?php echo $row['bukti_pembayaran'] ?>"
            />
          <!-- <h3 class="menu-card-title">~  ~</h3>
          <p class=""></p> -->
        </div>

      
      </div>
    </section>
    <!-- Menu Section End -->
    <!-- Feather Icons -->
    <script>
      feather.replace();
    </script>

    <!-- My Javascript-->
    <script src="../js/script.js"></script>
  </body>
</html>
