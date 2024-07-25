<!-- cek pesan notifikasi -->
<?php
if (isset($_GET['pesan'])) {
  if ($_GET['pesan'] == "gagal") {
    echo "Login gagal! username dan password salah!";
  } else if ($_GET['pesan'] == "logout") {
    echo "Anda telah berhasil logout";
  } else if ($_GET['pesan'] == "belum_login") {
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
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,700;1,700&display=swap" rel="stylesheet" />


  <!-- Feather Icons -->
  <script src="https://unpkg.com/feather-icons"></script>


  <!-- login template -->
  <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.2.0/css/all.css'>
  <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.2.0/css/fontawesome.css'>
  <link rel="stylesheet" href="../login-template/dist/style.css">

  <!-- My Css -->
  <!-- <link rel="stylesheet" href="css/register.css"> -->
</head>

<body>


  <div class="welcome">
    <a href="login.php"><i data-feather="corner-up-left"></i></a>
    <h1> Welcome To Catering<span>ku</span>.</h1>

  </div>

  <!-- partial:index.partial.html -->
  <div class="container">
    <div class="screen">
      <div class="screen__content">
        <form class="login" action="" method="post">
          <div class="login__field">
            <i class="login__icon fas fa-user"></i>
            <input type="text" name="name" class="login__input" placeholder="Nama" required>
          </div>
          <div class="login__field">
            <i class="login__icon fas fa-user"></i>
            <input type="text" name="username" class="login__input" placeholder="User name" required>
          </div>
          <div class="login__field">
            <i class="login__icon fas fa-lock"></i>
            <input name="password" id="password" type="password" class="login__input" placeholder="Password" required>
          </div>
          <div class="login__field">
            <i class="login__icon fas fa-user"></i>
            <input class="login__input" type="text" name="alamat" id="alamat" placeholder="Masukkan Alamat" required>
          </div>
          <div class="login__field">
            <i class="login__icon fas fa-user"></i>
            <input class="login__input" type="text" name="telp" id="telp" placeholder="Masukkan No Telp" required>
          </div>
          <button class="button login__submit" type="submit" name="buat" id="buat">
            <span class="button__text">Sign up</span>
            <i class="button__icon fas fa-chevron-right"></i>
          </button>
        </form>
      </div>

      <div class="screen__background">
        <span class="screen__background__shape screen__background__shape4"></span>
        <span class="screen__background__shape screen__background__shape3"></span>
        <span class="screen__background__shape screen__background__shape2"></span>
        <span class="screen__background__shape screen__background__shape1"></span>
      </div>
    </div>

  </div>
  <!-- partial -->



  <?php

  if (isset($_POST['buat'])) {
    // menghubungkan dengan koneksi
    include '../database/db.php';

    // mengaktifkan session php
    session_start();

    // Ambil nilai dari form
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $password1 = md5($_POST['password1']);
    $alamat = $_POST['alamat'];
    $telp = $_POST['telp'];

    // Enkripsi password
    // $password = password_hash($password, PASSWORD_DEFAULT);

    // Simpan data ke database

    if ($password1 == $password) {
      $insert = mysqli_query($conn, "INSERT INTO tbl_user VALUES (null,'$name','$username','$password','$alamat','$telp')");

      if ($insert) {
        echo "<p style='color : green'>Update Success</p>";
        echo "<script>alert('Buat Akun Success!, Silahkan Login');window.location='login.php'</script>";
      } else {
        echo "<p style='color : red'>Buat Akun Failed</p>";
      }
    } else {
      echo "<script>alert('Konfirmasi Password Tidak Sesuai');window.location='register.php'</script>";
    }
  }
  ?>

  <!-- Feather Icons -->
  <script>
    feather.replace();
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>