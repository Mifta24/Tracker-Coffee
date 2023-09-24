<?php

include '../database/db.php';

if (isset($_POST['submit'])) {

    $qtybaru = $_POST['qty'];

    $update = mysqli_query($conn, "UPDATE  tbl_pemesanan SET qty='$qtybaru' WHERE id=' " . $_GET['id'] . " ' ");

    if ($update) {
        $produk = mysqli_query($conn, "SELECT * FROM tbl_product WHERE  product_name='" . $_GET['nmp'] . "' ");
        $p = mysqli_fetch_assoc($produk);

        if ($_GET['qty'] > $qtybaru) {
            $selisih = $_GET['qty'] - $qtybaru;
            $jumlahbaru = $p["stock"] + $selisih;
            echo $jumlahbaru;
            $updatestockbaru = mysqli_query($conn, "UPDATE tbl_product SET stock='$jumlahbaru' WHERE product_name='".$_GET['nmp']."'  ");
            if ($updatestockbaru) {
                echo "berhasil";
                header("location:keranjang.php");
            } else {
                echo "kontol";
                error_reporting(1);
            }
        } elseif ($_GET['qty'] < $qtybaru) {
            $selisih =$qtybaru - $_GET['qty'] ;
            $jumlahbaru = $p["stock"] - $selisih;
            echo $jumlahbaru;
            $updatestockbaru = mysqli_query($conn, "UPDATE tbl_product SET stock='$jumlahbaru' WHERE product_name=' " . $_GET['nmp'] . "'  ");
            if ($updatestockbaru) {
                echo "berhasil";
                header("location:keranjang.php");
            } else {
                echo "kontol";
                error_reporting(1);
            }
        }
    }
    else{
        header("location:keranjang.php");
    }
}
?>
