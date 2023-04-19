<?php
if(isset($_POST['submit'])){

// mengaktifkan session php
session_start();
 
// menghubungkan dengan koneksi
include '../database/db.php';
 
// menangkap data yang dikirim dari form
$username = mysqli_real_escape_string($conn,$_POST['username']);
$password = md5($_POST['password']);

// Login Admin
 
// menyeleksi data admin dengan username dan password yang sesuai
$data = mysqli_query($conn,"SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'");

// registrasi

$regis=mysqli_query($conn,"SELECT * FROM tbl_user WHERE username='$username' AND password='$password'");

$userlog=mysqli_num_rows($regis);
 
// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($data);
 
if($cek > 0){
	$_SESSION['username'] = $username;
	$_SESSION['status'] = "login";
	header("location:../admin/admin.php");
}
elseif($userlog>0){
	$_SESSION['username'] = $username;
	$_SESSION['status'] = "login";
	header("location:../user/user.php");
}
else{
	header("location:login.php?pesan=gagal");
}
// if($userlog > 0){
// 	$_SESSION['username'] = $username;
// 	$_SESSION['status'] = "login";
// 	header("location:user.php");
// }else{
// 	header("location:login.php?pesan=gagal");
// }
 }
?>