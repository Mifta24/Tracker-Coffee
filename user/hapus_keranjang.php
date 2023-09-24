<?php

session_start();

include '../database/db.php';

if (isset($_GET['idm']) && isset($_GET['nmp']) && isset($_GET['qty'])) {
    
    $produk = mysqli_query($conn, "SELECT * FROM tbl_product WHERE  product_name='" . $_GET['nmp'] . "' ");
    $p = mysqli_fetch_assoc($produk);
    
    $jumlahbaru = $p["stock"] + $_GET['qty'];
    echo $jumlahbaru;
    
    $updatestockbaru = mysqli_query($conn, "UPDATE tbl_product SET stock='$jumlahbaru' WHERE product_name=' " . $_GET['nmp'] . "'  ");
    
    var_dump($updatestockbaru);
    
    if ($updatestockbaru) {
        echo "berhasil";
        $delete = mysqli_query($conn, "DELETE FROM tbl_pemesanan WHERE id=' " . $_GET['idm'] . " ' ");
        header("location:keranjang.php");
    } else {
        echo "kontol";
        error_reporting(1);
    }
    unset($_GET['idm']);

    unset($_SESSION['name_product']);
}
