<?php

session_start();
include 'db.php';
	if($_SESSION['status']!="login"){
		header("location:login.php?pesan=belum_login");
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

<!-- CKEditor 5 -->
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
</head>
<body>
 
	<header>
		<a href="index.html" class="logo">Tracker<span>coffee</span>.</a>
      <div class="nav">
        <a href="admin.php">Dashboard</a>
        <a href="profil.php">Profil</a>
        <a href="kategori.php">Data Kategori</a>
        <a href="#">Data Produk</a>
      </div>

      <div class="navbar-extra">
        <a href="#" id="hamburger-menu"> <i data-feather="menu"></i></a>
		<a href="logout.php">LOGOUT</a>
      </div>
	</header>
 
    <section class="profil">
		<h2>Tambah Produk</h2>
        <!-- encytype="multipart/form-data untuk input file" -->
		<form action="" method="post" enctype="multipart/form-data">
		
        <select name="menu" id="menu" class="input-control">
            <?php $kategori=mysqli_query($conn,"SELECT * FROM tbl_category ORDER BY category_id");
            
            

            while($row=mysqli_fetch_array($kategori)) :
            ?>
            <option value="<?php echo $row['category_id'] ?>"><?php echo $row['category_name'] ?></option>

            <?php endwhile; ?>
        </select>

        <input type="text" class="input-control" name="nama_produk" id="nama_prduk" placeholder="Nama Produk" value="">
        <input type="text" name="harga" id="" class="input-control" placeholder="Harga">
        <input type="text" name="stok" id="stok" class="input-control" placeholder="Stok">
        <input type="file" name="gambar" id="gambar" class="input-control" placeholder="Masukkan Gambar">
        <textarea name="deskripsi" id="deskripsi" cols="40" rows="5" class="input-control"></textarea>
        <br>
        <select name="status" id="status" class="input-control">
            <option  value="">Pilih...</option>
            <option value="1">On Sale</option>
            <option value="0">Not For Sale</option>
        </select>

        <input type="submit" class="btn" name="submit" id="submit" placeholder="Submit">

    </form>

	<!-- update fata ke data base -->
	<?php

	// Untuk membesarkan huruf depan ucwords()

		if (isset($_POST['submit'])) {
            // Menampung inputan form
            $kategori_menu=$_POST['menu'];
			$nama_produk=$_POST['nama_produk'];
			$harga=$_POST['harga'];
            $stok=$_POST['stok'];
			$deskripsi=$_POST['deskripsi'];
			$status=$_POST['status'];

            // Menampung data file yg diuplod

            $filename= $_FILES['gambar']['name'];
            $tmpname= $_FILES['gambar']['tmp_name'];
            
            $type1=explode('.', $filename);
            $type2=$type1[1];
            
            $newimage='img'.time().'.'.$type2;
            // menampung data file yg diizinkan
            $tipefile=array("jpg","jpeg","png","gif");
            // validasi format file
            if(!in_array($type2,$tipefile)){
                echo "<script> alert('Format File Tidak Dizinkan')</script>";
            }
            else{
                echo move_uploaded_file($tmpname,'./img/coffee-menu/'.$newimage);
                

                // proses upload sekalikus insert ke database
                $insert=mysqli_query($conn,"INSERT INTO tbl_product VALUES(null,'$kategori_menu','$nama_produk','$harga','$stok','$deskripsi','$newimage','$status')");

                if ($insert) {
                    echo "<script> window.location='produk.php'</script>";
                }
                else {
                    echo "<script> alert('Input Gagal')</script>";
                }
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

      <!-- CKEditorr 5 -->

      <script>
                        ClassicEditor
                                .create( document.querySelector( '#deskripsi' ) )
                                .then( editor => {
                                        console.log( editor );
                                } )
                                .catch( error => {
                                        console.error( error );
                                } );
                </script>
</body>
</html>