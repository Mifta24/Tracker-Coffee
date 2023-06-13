<?php 
session_start();

include'../database/db.php';


if(isset($_POST['bayar'])){

    // ambil data
    $nama=$_POST['name_user'];
    $nomor=$_POST['no_telp'];
    $alamat=$_POST['alamat'];
    $total=$_POST['total'];
    // echo $total;
    $catatan=$_POST['comment'];
    $pesanan=$_POST['pesanan'];

    // Metode Pembayaran
    $gopay=$_POST['gopay'];
    $dana=$_POST['dana'];
    $ovo=$_POST['ovo'];


    // MEMBUAT KODE PADA PEMBAYARAN
        //ambil data terbesar 
        $char = 'BYR';
		$query=mysqli_query($conn,"SELECT max(kd_bayar) as max_kode FROM tbl_pembayaran ");
		$data = mysqli_fetch_array($query);
		$kodeBayar = $data['max_kode'];

        //mengambil data menggunakan fungsi subtr, 
        //misal data BRG001 akan diambil 001 
		$no = substr($kodeBayar, -3, 3);

        //setelah substring bilangan diambil lantas dicasting menjadi integer
		 $no = (int) $no;

         //bilangan yang diambil akan ditambah 1 untuk menentukan nomor urut berikutnya
		 $no += 1;

         //perintah sprintf("%03s", $no) berguna untuk membuat string menjadi 3 karakter
		$newKodeBayar = $char . sprintf("%03s", $no);

        //nomor urut baru
        // echo $newKodeBayar;
		
    
    // KONDISI Metode PEmbayaran
    if(isset($dana)){
        $_SESSION['dana']=$dana;
        $_SESSION['pesanan']=$pesanan;
        $_SESSION['kd']=$newKodeBayar;

        // echo $_SESSION['kd'];

        mysqli_query($conn,"INSERT INTO tbl_pembayaran VALUES(null,'$newKodeBayar','$nama','$nomor','$alamat','$pesanan','$catatan','$dana','$total',null,null)");
        header('location:qr.php');
    }
    elseif(isset($gopay)){
        $_SESSION['gopay']=$gopay;
        $_SESSION['pesanan']=$pesanan;
        $_SESSION['kd']=$newKodeBayar;
        mysqli_query($conn,"INSERT INTO tbl_pembayaran VALUES(null,'$newKodeBayar','$nama','$nomor','$alamat','$pesanan','$catatan','$gopay','$total',null,null)");
        header('location:qr.php');
    }

    elseif(isset($ovo)){
        $_SESSION['ovo']=$ovo;
        $_SESSION['pesanan']=$pesanan;
        $_SESSION['kd']=$newKodeBayar;
        mysqli_query($conn,"INSERT INTO tbl_pembayaran VALUES(null,'$newKodeBayar','$nama','$nomor','$alamat','$pesanan','$catatan','$ovo','$total',null,null)");
        header('location:qr.php');
    }
    else{
        echo "<script> alert('Anda Tidak Memilih Metode Pembayaran');window.location='index.php'</script>";
    }


}

?>