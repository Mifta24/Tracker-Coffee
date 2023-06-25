<?php 
// mengaktifkan session
session_start();
 
// menghapus semua session
session_destroy();
session_unset();


 
// mengalihkan halaman sambil mengirim pesan logout
header("location:../login/login.php");
echo "<script> alert('Anda Telah Logout') </script>"
?>