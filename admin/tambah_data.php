<?php

// koneksi database
include '../database/db.php';

// Kondisi jika belum login
session_start();
if ($_SESSION['status'] != "login") {
	header("location:../login/login.php?pesan=belum_login");
}

	include 'layout/header.php';

	?>




<section class="add-data">
    <div class="container">
        <h2>Tambah Data</h2>

        <form action="" method="post">
            <div class="form-group">
                <label for="nama_menu">Nama Menu</label>
                <input type="text" class="form-control" name="nama_menu" id="nama_menu" placeholder="Nama Menu" value="">
            </div>
            <button type="submit" class="btn btn-primary" name="submit" id="submit">Submit</button>
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
     </div>
	 </section>



	<?php
		include 'layout/footer.php';
	?>