    <!-- cek apakah sudah login -->
	<?php 
	session_start();
  include '../database/db.php';
  
    if($_SESSION['status']!="login"){
      header("location:../login/login.php?pesan=belum_login");
    };
  
	?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

	<link rel="stylesheet" href="css/kategori.css">
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

		<section class="dashboard" >
            <div class="box">
              <a href="tambah_data.php">Tambah Data</a>
                <table border="1" cellpadding=8 cellspacing="0" bordercolor="black">
                    <thead>

                        <tr>
                            <td>No</td>
                            <td>Menu</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
    <?php 
        $kategori=mysqli_query($conn,"SELECT * FROM tbl_category ORDER BY category_id");
        $i=0;
        while($row=mysqli_fetch_array($kategori)) :
            $i++;
    ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $row['category_name']; ?></td>
                            <td>
                              <a href="edit_menu.php?id=<?php echo $row['category_id'] ?>">Edit</a> 
                            || <a href="hapus_menu.php?idk=<?php echo $row['category_id'] ?> " onclick="return confirm('Yakin ingin menghapus data ini ?')">Hapus</a>
                           </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
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