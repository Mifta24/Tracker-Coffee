<?php
include '../database/db.php';

// Kondisi jika belum login
session_start();
if ($_SESSION['status'] != "login") {
	header("location:../login/login.php?pesan=belum_login");
}

// data tbl_admin
$query = mysqli_query($conn, "SELECT * FROM tbl_admin");
// var_dump($admin);

// ngambil data satu persatu
while ($admin = mysqli_fetch_array($query)) {
	$admin_id = stripslashes($admin['admin_id']);
	$admin_name = stripslashes($admin['admin_name']);
	$username = stripslashes($admin['username']);
	$nohp = stripslashes($admin['admin_telp']);
	$alamat = stripslashes($admin['admin_address']);
	$email = stripslashes($admin['admin_email']);
	$image = stripslashes($admin['admin_image']);
}

	include_once 'layout/header.php';
?>

  <!-- Custom CSS -->
  <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .profil {
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .profil h2 {
            margin-bottom: 20px;
            font-size: 1.5rem;
            color: #343a40;
        }

        .input-control {
            margin-bottom: 10px;
        }

        .input-control input {
            border-radius: 4px;
        }

        .btn {
            border-radius: 4px;
        }

        .alert {
            margin-top: 20px;
        }
    </style>



	 <!-- Profil Admin Start -->
    <section class="profil container mt-4">
        <h2>Profil</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <img src="../img/asset/profil/<?= $image ?>" alt="Profile Image" class="img-thumbnail mb-3" width="100px">
            </div>

            <!-- Gambar Upload -->
            <div class="form-group">
                <label for="gambar">Upload Gambar:</label>
                <input type="file" class="form-control-file" name="gambar" id="gambar">
            </div>

            <!-- Nama Admin -->
            <div class="form-group">
                <label for="nama">Nama Lengkap:</label>
                <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Lengkap" value="<?= $admin_name; ?>">
            </div>

            <!-- Username Login -->
            <div class="form-group">
                <label for="user">Username:</label>
                <input type="text" class="form-control" name="user" id="user" placeholder="Username" value="<?= $username ?>">
            </div>

            <!-- No Hp Admin -->
            <div class="form-group">
                <label for="hp">No-HP:</label>
                <input type="text" class="form-control" name="hp" id="hp" placeholder="No-HP" value="<?= $nohp ?>">
            </div>

            <!-- Email Admin -->
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="<?= $email ?>">
            </div>

            <!-- Alamat Admin -->
            <div class="form-group">
                <label for="alamat">Alamat:</label>
                <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat" value="<?= $alamat ?>">
            </div>

            <!-- Tombol Submit -->
            <button type="submit" class="btn btn-primary" name="submit" id="submit">Submit</button>
        </form>

        <!-- update data ke database -->
        <?php
        if (isset($_POST['submit'])) {
            $nama = ucwords($_POST['nama']);
            $user = $_POST['user'];
            $hp = $_POST['hp'];
            $email_ad = $_POST['email'];
            $alamat_ad = ucwords($_POST['alamat']);

            // Menampung data file yg diupload
            $filename = $_FILES['gambar']['name'];
       

            $tmpname = $_FILES['gambar']['tmp_name'];
            $type1 = explode('.', $filename);
            $type2 = strtolower(end($type1));
            
            $newimage = 'img' . time() . '.' . $type2;
            $tipefile = array("jpg", "jpeg", "png", "gif");
        
        

            // Validasi format file
            if (!in_array($type2, $tipefile)) {
                echo "<div class='alert alert-danger' role='alert'>Format File Tidak Dizinkan</div>";
            } else {
                if (move_uploaded_file($tmpname, '../img/asset/profil/' . $newimage)) {
                    // Query data
                    $update = mysqli_query($conn, "UPDATE tbl_admin SET 
                        admin_name='$nama',
                        username='$user',
                        admin_telp='$hp',
                        admin_email='$email_ad',
                        admin_address='$alamat_ad',
                        admin_image='$newimage'
                        WHERE admin_id='$admin_id'");

                    // Kondisi sesudah query
                    if ($update) {
                        echo "<div class='alert alert-success' role='alert'>Update Success</div>";
                        echo "<script>window.location='profil.php'</script>";
                    } else {
                        echo "<div class='alert alert-danger' role='alert'>Update Failed</div>";
                    }
                } else {
                    echo "<div class='alert alert-danger' role='alert'>Gagal Upload Gambar</div>";
                }
            }
        }
        ?>
    </section>
    <!-- Profil Admin End -->
	
	   <!-- Ubah Password Start -->
	   <section class="profil container mt-4">
        <h2>Ubah Password</h2>
        <form action="" method="post">
            <!-- Password Baru -->
            <div class="form-group">
                <label for="pass1">Masukkan Password Baru:</label>
                <input type="password" class="form-control" name="pass1" id="pass1" placeholder="Masukkan Password Baru" required>
            </div>

            <!-- Konfirmasi Password -->
            <div class="form-group">
                <label for="pass2">Konfirmasi Password Baru:</label>
                <input type="password" class="form-control" name="pass2" id="pass2" placeholder="Konfirmasi Password Baru" required>
            </div>

            <!-- Submit Password -->
            <button type="submit" class="btn btn-warning" name="ubah_password" id="ubah_password">Ubah Password</button>
        </form>

        <!-- Php ubah password -->
        <?php
        if (isset($_POST['ubah_password'])) {
            $pass1 = md5($_POST['pass1']);
            $pass2 = md5($_POST['pass2']);

            if ($pass2 != $pass1) {
                echo "<div class='alert alert-danger' role='alert'>Konfirmasi Password Tidak Sesuai</div>";
            } else {
                $u_pass = mysqli_query($conn, "UPDATE tbl_admin SET 
                password='$pass1'
                WHERE admin_id='$admin_id'");

                if ($u_pass) {
                    echo "<div class='alert alert-success' role='alert'>Ubah Data Berhasil</div>";
                    echo "<script>window.location='profil.php'</script>";
                }
            }
        }
        ?>
    </section>
    <!-- Ubah Password End -->


	