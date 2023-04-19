    <!-- cek apakah sudah login -->
	<?php 
	session_start();
	if($_SESSION['status']!="login"){
		header("location:../login.php?pesan=belum_login");
	}
	?>
	
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

	<link rel="stylesheet" href="css/admin.css">
</head>
<body>
 
	<header>
		<a href="index.html" class="logo">Tracker<span>coffee</span>.</a>
      <div class="nav">
        <a href="admin.php">Dashboard</a>
        <a href="profil.php">Profil</a>
        <a href="kategori.php">Data Kategori</a>
        <a href="produk.php">Data Produk</a>
      </div>

      <div class="navbar-extra">
        <a href="#" id="hamburger-menu"> <i data-feather="menu"></i></a>
		<a href="logout.php">LOGOUT</a>
      </div>
	</header>

	<section class="dashboard">
		<h3>Dashboard</h3>
		<div class="box">
			<p>Selamat Datang Admin</p>
		</div>
	</section>
 
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
</body>
</html>