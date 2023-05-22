<?php
session_start();
include '../database/db.php';

// Jika belum login maka akan di alihkan ke halaman login
if ($_SESSION['status'] != "login") {
  header("location:../login/login.php?pesan=belum_login");
};

//  ambil data dari tbl_product sesuai id yang didapat dari url
$produk = mysqli_query($conn, "SELECT * FROM tbl_product WHERE product_id='" . $_GET['id'] . "' ");

// data diambil satu persatu dibungkus ke dalam object
$p = mysqli_fetch_object($produk);
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
    <a href="index.php" target="_blank"  class="logo">Tracker<span>coffee</span>.</a>
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
    <h2>Edit Menu</h2>

    <form action="" method="post" enctype="multipart/form-data">

        <!-- Kategori menu -->
      <select name="menu" id="menu" class="input-control">

        <?php $kategori = mysqli_query($conn, "SELECT * FROM tbl_category ORDER BY category_id");
        // ulangi option sesuai dengan isi data 
        while ($row = mysqli_fetch_array($kategori)) :
        ?> 
          <!-- Kategori Produk , jika category_id di tbl_category sesuai dengan category_id di tbl_product maka pilih -->
          <option name="menu" value="<?php echo $row['category_id']; ?>" <?php echo ($row['category_id'] == $p->category_id) ? 'selected' : ''; ?>>
            <!-- menampilkan kategori nama sesuai id -->
           <?php echo $row['category_name'] ?>
          </option>
        <?php endwhile; ?>

      </select>

      <!-- Nama Produk -->
      <input type="text" class="input-control" name="nama_produk" id="nama_prduk" placeholder="Nama Produk" value="<?php echo $p->product_name ?>">

      <!-- Harga -->
      <input type="text" name="harga" id="" class="input-control" placeholder="Harga" value="<?php echo $p->product_price ?>">

      <!-- Stock -->
      <input type="text" name="stok" id="stok" class="input-control" placeholder="Stok" value="<?php echo $p->stock ?>">

      <!-- Nama file lama -->
      <input type="text" name="foto" value="<?php echo $p->product_image ?>">

      <!-- Tampilan gambar lama -->
      <img src="img/coffee-menu/<?php echo $p->product_image ?>" width="100px" alt="">

      <!-- input gambar -->
      <input type="file" name="gambar" id="gambar" class="input-control" placeholder="Masukkan Gambar" value="">


      <!-- Deskripsi Produk -->
      <textarea name="deskripsi" id="" cols="40" rows="5" class="input-control"><?php echo $p->product_description ?></textarea>

      <!-- Status Penjualan -->
      <select name="status" id="status" class="input-control">
        <option value="">Pilih...</option>
        <option value="1" <?php echo ($p->product_status == 1) ? 'selected' : ''; ?>>On Sale</option>
        <option value="0" <?php echo ($p->product_status == 0) ? 'selected' : ''; ?>>Not For Sale</option>
      </select>

      <input type="submit" class="btn" name="submit" id="submit" placeholder="Submit">
    </form>

    <!-- update data ke data base -->
    <?php

    // Untuk membesarkan huruf depan ucwords()

    if (isset($_POST['submit'])) {

      // Menampung inputan form
      $kategori_menu = $_POST['menu'];
      $nama_produk = $_POST['nama_produk'];
      $harga = $_POST['harga'];
      $stok = $_POST['stok'];
      $deskripsi = $_POST['deskripsi'];
      $status = $_POST['status'];

      // nama file foto lama
      $fotoLama= $_POST['foto'];

      // Menampung data file yg diuplod
      $filename = $_FILES['gambar']['name'];
      $tmpname = $_FILES['gambar']['tmp_name'];

      // var_dump($filename);
      // var_dump($tmpname);


      //  Jika admin ganti gambar
      if ($filename != '') {


        $type1 = explode('.', $filename);
        $type2 = end($type1);

        // namawaktu.exe
        $newimage = 'img' . time() . '.' . $type2;


        // menampung data file yg diizinkan
        $tipefile = array("jpg", "jpeg", "png", "gif");


        // validasi format file

        // jika ekstensi file tidak sesuai tipe yang di izinkan
        if (!in_array($type2, $tipefile)) {
          echo "<script> alert('Format File Tidak Dizinkan')</script>";
        }

        // jika sesuai
        else {

          // mengapus file lama ynag tersimpan
          unlink("../img/coffee-menu/" . $fotoLama);

          // untuk memindahkan file yang di upload
         echo move_uploaded_file($tmpname, '../img/coffee-menu/' . $newimage);

          // 
          $nama_gambar = $newimage;
        }
      }

      // jika admin tidak ganti gambar
      else {

        $nama_gambar = $fotoLama;
      }


      // proses upload sekalikus insert ke database
      $update = mysqli_query($conn, " UPDATE  tbl_product SET 
                                      category_id='$kategori_menu',
                                      product_name='$nama_produk',
                                      product_price='$harga',
                                      stock='$stok',
                                      product_image='$nama_gambar',
                                      product_description='$deskripsi',
                                      product_status='$status'

                                      WHERE product_id='$p->product_id' 
                                      
                                      ");


      // kondisi sesudah di update
      if ($update) {
        echo "<script> window.location='produk.php'</script>";
      } else {
        echo "<script> alert('Input Gagal')</script>";
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
      <a href="index.php #home">Home</a>
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