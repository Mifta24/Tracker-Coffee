<?php

session_start();

include'../database/db.php';


if(isset($_POST['cek'])){
    // $pem=mysqli_query($conn,"SELECT * FROM tbl_pembayaran WHERE menu=' ".$_SESSION['pesanan']."' ");
    // $p=mysqli_fetch_object($pem);
   // Menampung data file yg diuplod

   $filename= $_FILES['bukti']['name'];
   $tmpname= $_FILES['bukti']['tmp_name'];
   
   $type1=explode('.', $filename);
   $type2=$type1[1];
   
   $newimage='img'.time().'.'.$type2;
   // menampung data file yg diizinkan
   $tipefile=array("jpg","jpeg","png","gif");
   // validasi format file
   if(!in_array($type2,$tipefile)){
    echo "<script> alert('Format Tidak Diizinkan');window.location='qr.php'</script>";
   }
   else{
        move_uploaded_file($tmpname,'../img/asset/bukti-pembayaran/'.$newimage);
       $user=$_SESSION['username'];
       $pesanan=$_SESSION['pesanan'];
       $kd=$_SESSION['kd'];

    //    echo $kd;

        // echo $user;
        // echo $pesanan;

       // proses upload sekalikus insert ke database
       $update=mysqli_query($conn,"UPDATE tbl_pembayaran SET bukti_pembayaran='$newimage'  WHERE user='$user' AND   kd_bayar='$kd' ");

       if ($update) {
       $status= mysqli_query($conn,"UPDATE tbl_pembayaran SET payment_status='Menunggu Proses' WHERE user='$user' AND kd_bayar='$kd' ");
            $_SESSION['payment']='Menunggu Proses';
            mysqli_query($conn,"UPDATE tbl_pemesanan SET payment_status='Menunggu Proses'  WHERE user='$user' ");
           echo "<script> alert('Pembayaran Success');window.location='../user/user.php'</script>";
       
       }
       else {
           echo "<script> alert('Pembayaran Gagal');window.location='qr.php'</script>";
       }
   }
}
?>