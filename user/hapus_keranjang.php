<?php

include '../database/db.php';

if(isset($_GET['idm'])){
    $delete=mysqli_query($conn,"DELETE FROM tbl_pemesanan WHERE id=' ".$_GET['idm']." ' ");
    header("location:keranjang1.php");
}



?>