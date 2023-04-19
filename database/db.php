<?php
$hostname="localhost";
$username="root";
$password="";
$database="tracker_coffee";

$conn=mysqli_connect($hostname,$username,$password) or die("koneksi gagal");
$db=mysqli_select_db($conn,$database) or die("Database tidak dapat dibuka");
?>