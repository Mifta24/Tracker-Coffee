<?php

include 'db.php';

if(isset($_GET['idk'])){
    $delete=mysqli_query($conn,"DELETE FROM tbl_category WHERE category_id=' ".$_GET['idk']." ' ");
    header("location:kategori.php");
}

if(isset($_GET['idp'])){
    // $gambar=mysqli_query($conn,"SELECT product_image WHERE product_id' ".$_GET['idp']." ' ");
    // $gam=mysqli_fetch_assoc($gambar);

    // var_dump($gam);

    // // untuk menghapus gambar
    // unlink("img/coffee-menu/".$gam['product_image']);

    $delete=mysqli_query($conn,"DELETE FROM tbl_product WHERE product_id=' ".$_GET['idp']." ' ");
    header("location:produk.php");
}

?>