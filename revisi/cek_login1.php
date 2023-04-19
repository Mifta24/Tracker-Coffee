<?php 
 
//  if(isset($_POST['submit'])){
	 // mengaktifkan session php
	 session_start();
	 // menghubungkan dengan koneksi
	 include 'db.php';

 // menangkap data yang dikirim dari form
 $username = $_POST['username'];
 $password = $_POST['password'];
 
 // menyeleksi data admin dengan username dan password yang sesuai
 $data = mysqli_query($conn,"SELECT * FROM tbl_admin WHERE username='$username' AND password ='MD5($password)'");
 
 // menghitung jumlah data yang ditemukan
 $cek = mysqli_num_rows($data);
 
 echo $cek;
  if($cek > 0){
	header("location:admin.php");
  }else{
    echo "<script> Alert('login gagal'); window.location'login.html' </script>";
	// header("location:login.html");
 }


// }

?>
