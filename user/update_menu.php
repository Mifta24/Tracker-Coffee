<?php

include '../database/db.php';

if(isset($_POST['submit'])){

    $qtybaru=$_POST['qty'];

    $update=mysqli_query($conn,"UPDATE  tbl_pemesanan SET qty='$qtybaru' WHERE id=' ".$_GET['id']." ' ");
    header("location:keranjang1.php");
}



?>