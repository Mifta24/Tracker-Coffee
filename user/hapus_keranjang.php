<?php

session_start();
include '../database/db.php';

if(isset($_GET['idm'])){
    $delete=mysqli_query($conn,"DELETE FROM tbl_pemesanan WHERE id=' ".$_GET['idm']." ' ");
    header("location:keranjang.php");

    $produk=mysqli_query($conn,"SELECT * FROM tbl_product");
    $p=mysqli_fetch_assoc($produk);

    $jumlahbaru=$p["stock"]+$_SESSION['cart'][$product_id]['quantity'];
    echo $jumlahbaru;

    $updatestockbaru=mysqli_query($conn,"UPDATE tbl_product SET stock='$jumlahbaru' WHERE product_name=' ".$_SESSION['product_name']." ' ");

    unset($_GET['idm']);
    unset($_SESSION['name_product']);
    unset($_SESSION['cart'][$product_id]['name_product']);
    unset($_SESSION['cart'][$product_id]['quantity']);
}



?>