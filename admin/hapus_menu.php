<?php

include '../database/db.php';

if(isset($_GET['idk'])){
    $delete=mysqli_query($conn,"DELETE FROM tbl_category WHERE category_id=' ".$_GET['idk']." ' ");
    header("location:kategori.php");
}

if(isset($_GET['idp'])){
    
    $delete=mysqli_query($conn,"DELETE FROM tbl_product WHERE product_id=' ".$_GET['idp']." ' ");
    header("location:produk.php");
}

?>