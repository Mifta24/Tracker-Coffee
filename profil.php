<?php

session_start();
include 'db.php';
	if($_SESSION['status']!="login"){
		header("location:login.php?pesan=belum_login");
	}

	$query=mysqli_query($conn,"SELECT * FROM tbl_admin");
	// var_dump($admin);
	
	// ngambil data satu persatu
	while ( $admin = mysqli_fetch_array ($query)) {
		$admin_id    = stripslashes ($admin['admin_id']);
		$admin_name    = stripslashes ($admin['admin_name']);
		$username           = stripslashes ($admin['username']);
		$nohp         = stripslashes ($admin['admin_telp']);
		$alamat         = stripslashes ($admin['admin_address']);
		$email        = stripslashes ($admin['admin_email']);
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

	<link rel="stylesheet" href="profil.css">
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
 
    <section class="profil">
		<h2>Profil</h2>
		<form action="" method="post">
		
        <input type="text" class="input-control" name="nama" id="nama" placeholder="Nama Lengkap" value="<?= $admin_name;?>">
        <input type="text" class="input-control" name="user" id="user" placeholder="Username" value="<?= $username?>">
        <input type="text" class="input-control" name="hp" id="hp" placeholder="No-HP" value="<?= $nohp ?>">
        <input type="text" class="input-control" name="email" id="email" placeholder="Email" value="<?= $email?>">
        <input type="text" class="input-control" name="alamat" id="alamat" placeholder="Alamat" value="<?= $alamat ?>">
        <input type="submit" class="btn" name="submit" id="submit" placeholder="Submit">

    </form>

	<!-- update fata ke data base -->
	<?php

	// Untuk membesarkan huruf depan ucwords()

		if (isset($_POST['submit'])) {
			$nama =ucwords( $_POST['nama']);
			$user= $_POST['user'];
			$hp= $_POST['hp'];
			$email_ad= $_POST['email'];
			$alamat_ad= ucwords( $_POST['alamat']);

			$update=mysqli_query($conn,"UPDATE tbl_admin SET 
				admin_name='$nama',
				username='$user',
				admin_telp='$hp',
				admin_email='$email_ad',
				admin_address='$alamat_ad'

				WHERE admin_id= $admin_id");

			if ($update) {
				echo "<p style='color : green'>Update Success</p>";
				echo "<script>window.location='profil.php'</script>";
			}
			else {
				echo "<p style='color : red'>Update Failed</p>";
			}
		}
	?>
    </section>

	<section class="profil">
		<h2>Ubah Password</h2>
		<form action="" method="post">
		
        <input type="password" class="input-control" name="pass1" id="pass1" placeholder="Masukkan Password Baru" value="">
        <input type="password" class="input-control" name="pass2" id="pass2" placeholder="Konfirmasi Password Baru" value="">
       
        <input type="submit" class="btn" name="ubah_password" id="ubah_password" value="Ubah Password">

    </form>
	</section>


	<?php

// Untuk membesarkan huruf depan ucwords()

	if (isset($_POST['ubah_password'])) {

		$pass1=md5($_POST['pass1']);
		$pass2=md5($_POST['pass2']);

		if($pass2 != $pass1){
			echo "<script> alert('Konfirmasi Password Tidak Sesuai') </script>";
		}
		else{
			$u_pass=mysqli_query($conn,"UPDATE tbl_admin SET 
			password='$pass1'
			WHERE admin_id= $admin_id");

			if($u_pass){
				echo "<script> alert('Ubah Data Berhasil') </script>";
				echo "<script>window.location='profil.php'</>";
			}
		}
		
	}
?>


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