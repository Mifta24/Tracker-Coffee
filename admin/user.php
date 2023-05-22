    <!-- cek apakah sudah login -->
	<?php 
	session_start();
	if($_SESSION['status']!="login"){
		header("location:../login.php?pesan=belum_login");
	}

    include'../database/db.php';

    $user=mysqli_query($conn,"SELECT * FROM tbl_user");
   
	?>
	
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data User</title>

       <!-- Fonts -->
       <link
       href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,700;1,700&display=swap"
       rel="stylesheet"
     />
 
     <!-- Feather Icons -->
     <script src="https://unpkg.com/feather-icons"></script>

	<link rel="stylesheet" href="css/user.css">
</head>
<body>
 
	<header>
		<a href="index.html" class="logo">Tracker<span>coffee</span>.</a>
      <div class="nav">
	  <a href="admin.php">Dashboard</a>
          <a href="profil.php">Profil</a>
          <a href="user.php">Data User</a>
          <a href="kategori.php">Data Kategori</a>
          <a href="produk.php">Data Produk</a>
          <a href="pemesanan.php">Data Pemesanan</a>
          <a href="penjualan.php">Data Penjualan</a>
      </div>

      <div class="navbar-extra">
        <a href="#" id="hamburger-menu"> <i data-feather="menu"></i></a>
		<a href="logout.php">LOGOUT</a>
      </div>
	</header>

	<div class="container">
    
        <?php while( $u=mysqli_fetch_assoc($user)):?>
        <div class="card">
            <h3><i data-feather="user"></i></h3>
            <div class="row">

                <h3>Username</h3>
                <p><?php echo $u['username'] ?></p>
            </div>
        
            <div class="row">
                <h3>Nama</h3>
                <p><?php echo $u['name_user'] ?></p>
                
            </div>
        
            <div class="row">
                <h3>No Telp</h3>
                <p><?php echo $u['no_telp'] ?></p>
                
            </div>
        
            <div class="row">
                <h3>Alamat</h3>
                <p><?php echo $u['alamat'] ?></p>
                
            </div>
                
            
        </div>
        <?php endwhile; ?>
    </div>
 
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
</body>
</html>