<?php
session_start();
include '../database/db.php';

	if($_SESSION['status']!="login"){
		header("location:../login/login.php?pesan=belum_login");
	};


    // untuk menyembunyikan pesan error yg errornya itu tidak terlalu berguna
    error_reporting(0);  // jika 0 maka sembunyikan. jika 1 tampilkan

    $id=$_GET['id'];

    $produk=mysqli_query($conn,"SELECT * FROM tbl_pembayaran WHERE id='$id' ");

    $p=mysqli_fetch_object($produk);


// DELETE   
    $idp=$_GET['idp'];
    $produkDel=mysqli_query($conn,"SELECT * FROM tbl_pembayaran WHERE id='$idp' ");

    $pd=mysqli_fetch_object($produkDel);
    
  

    // terima pembayaran
    if (isset($_POST['success'])) {
        $payment=$_POST['payment_status'];
    

        $update=mysqli_query($conn,"UPDATE tbl_pembayaran SET 
        payment_status='$payment' WHERE id='$p->id' ");

        if ($update) {
            mysqli_query($conn,"DELETE FROM tbl_pemesanan WHERE user='$p->user' ");
            echo "<script>alert('Pembayaran Disetujui');window.location='penjualan.php'</script>";
        }
        else {
            echo "<p style='color : red'>Update Failed</p>";
        }
    }

    // tolak pembayaran
    if(isset($_POST['tolak'])){
        $user=$_POST['user'];
        $delete=mysqli_query($conn,"DELETE FROM tbl_pembayaran WHERE id=' ".$_GET['idp']." ' ");
        mysqli_query($conn,"UPDATE tbl_pemesanan SET 
        payment_status=null WHERE user='$user' ");
        echo "<script>alert('Pembayaran Ditolak');window.location='penjualan.php'</script>";
    }
	?>