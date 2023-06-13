<?php

// koneksi database
include '../database/db.php';

// Kondisi jika belum login
session_start();
if ($_SESSION['status'] != "login") {
	header("location:../login/login.php?pesan=belum_login");
}

	?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

	<link rel="stylesheet" href="css/profil.css">
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
 
    <section class="profil">
		<h2>Tambah Data</h2>

		<form action="" method="post">
		
		<!-- inputan kategori yang ingin ditambah -->
        <input type="text" class="input-control" name="nama_menu" id="nama_menu" placeholder="Nama Menu" value="">

		<!-- submit -->
        <input type="submit" class="btn" name="submit" id="submit" placeholder="Submit">

    	</form>

	<!-- Masukkan data ke database -->
	<?php

	// Untuk membesarkan huruf depan ucwords()

		if (isset($_POST['submit'])) {
			$nama_menu=ucwords( $_POST['nama_menu']);

			$insert=mysqli_query($conn,"INSERT INTO tbl_category VALUES(null,'$nama_menu',null)");

			if ($insert) {
				echo "<p style='color : green'>Update Success</p>";
				echo "<script>window.location='kategori.php'</script>";
			}
			else {
				echo "<p style='color : red'>Update Failed</p>";
			}
		}
	?>
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