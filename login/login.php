
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
    <link rel="stylesheet" href="css/login.css">
</head>
<body>

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

    <div class="welcome">
      <a href="../index.php"><i data-feather="corner-up-left"></i></a>
      <h1> Welcome To Tracker<span>Coffee</span>.</h1>

    </div>

    <div class="login-box">
        <img src="../img/avatar.jpg" alt="User" class="avatar">
        <h1>Login Disini</h1>
        
        <form  action="cek_login.php" method="post">
            <!-- <p>Username</p> -->
           <input class="user" type="text" name="username" placeholder="Username">

           <!-- <p>Password</p> -->
           <input class="password" type="password" name="password" id="password" placeholder="Password">
    
           <input class="submit" type="submit" name="submit" value="Login">
    
           
           <a href="#">Forget Password ?</a>
            <br>
           <a  href="register.php">Belum Memiliki Akun ?</a>
        </form>
    </div>

        
     <!-- Feather Icons -->
     <script>
      feather.replace();
    </script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>