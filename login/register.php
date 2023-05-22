<!-- cek pesan notifikasi -->
<?php 
	if(isset($_GET['pesan'])){
		if($_GET['pesan'] == "gagal"){
			echo "Login gagal! username dan password salah!";
		}else if($_GET['pesan'] == "logout"){
			echo "Anda telah berhasil logout";
		}else if($_GET['pesan'] == "belum_login"){
			echo "Anda harus login untuk mengakses halaman admin";
		}
	}
	?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tracker Coffee Login User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


    <!-- My font -->
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,700;1,700&display=swap"
      rel="stylesheet"
    />


     <!-- Feather Icons -->
     <script src="https://unpkg.com/feather-icons"></script>

    <!-- My Css -->
    <link rel="stylesheet" href="css/register.css">
</head>
<body>


    <div class="welcome">
      <a href="login.php"><i data-feather="corner-up-left"></i></a>
      <h1> Welcome To Tracker<span>Coffee</span>.</h1>

    </div>

    <div class="login-box">
        <img src="../img/avatar.jpg" alt="User" class="avatar">
        <h1>Buat Akun Disini</h1>
        
        <form  action="" method="post">
          <div class="subform">

            <div class="akun">
  
              <input class="user" type="text" name="name" placeholder="Masukkan Nama">
              <input class="user" type="text" name="username" placeholder="Buat Username">
   
              <!-- <p>Password</p> -->
              <input class="password" type="password" name="password" id="password" placeholder="Buat Password">
            </div>
            
            <div class="data">
              
              <input class="user" type="text" name="alamat" id="alamat" placeholder="Masukkan Alamat">
              
              <input class="user" type="text" name="telp" id="telp" placeholder="Masukkan No Telp">
              <input class="password" type="password" name="password1" id="password1" placeholder="Konfirmasi Password">
       
            </div>
          </div>
          
          <input class="submit" type="submit" name="buat" id="buat" value="Buat Akun">

          <a  href="login.php">Sudah Memiliki Akun ?</a>
           
        </form>
    </div>

    <?php

if(isset($_POST['buat'])){
     // menghubungkan dengan koneksi
     include '../database/db.php';

  // mengaktifkan session php
  session_start();
 
 // Ambil nilai dari form
$name = $_POST['name'];
$username = $_POST['username'];
$password = md5($_POST['password']);
$password1=md5($_POST['password1']);
$alamat=$_POST['alamat'];
$telp=$_POST['telp'];

// Enkripsi password
// $password = password_hash($password, PASSWORD_DEFAULT);

    // Simpan data ke database
    
    if($password1==$password){
      $insert= mysqli_query($conn,"INSERT INTO tbl_user VALUES (null,'$name','$username','$password','$alamat','$telp')");
    
      if ($insert) {
      echo "<p style='color : green'>Update Success</p>";
      echo "<script>alert('Buat Akun Success!, Silahkan Login');window.location='login.php'</script>";
      }
      else {
      echo "<p style='color : red'>Buat Akun Failed</p>";
      }
    }
    else{
      echo "<script>alert('Konfirmasi Password Tidak Sesuai');window.location='register.php'</script>";
    }
    // menghitung jumlah data yang ditemukan
    // if (mysqli_query($conn, $regis)) {
    //     echo "Registrasi berhasil";
    //     header('location:login.php');
    // } else {
    //     echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    // }
    
    
 

}
?>

     <!-- Feather Icons -->
     <script>
      feather.replace();
    </script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>