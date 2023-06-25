<?php 

session_start();    

if(!isset($_POST['id'])||empty($_GET['id'])){
    header('location:keranjang.php');
    exit;
}

$qty=1;

// jumlah belnja tidak boleh kosong
if(isset($_POST['qty'])){
    $qty=max($_POST['qty'],1);

}

// jika sesion keranjang belum ada
if(!isset($_SESSION['keranjang'])){
    // maka buat sesion keranjang yg isinya array kosong
    $_SESSION['keranjang']=[];
}

// jika produk belum ditambahkan keranjang
$id=$_GET['id'];
if(!isset($_SESSION['keranjang'][$id])){
    // key nya berupa array assoc
    $_SESSION['keranjang'][$id]=$qty;
} 
// jika isi keranjangnya sudah ada maka qtynya ditambah
else{
    $_SESSION['keranjang'][$id] +=$qty;
}

header('location: keranjang.php');
exit;

?>