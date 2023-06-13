<?php 

include '../database/db.php';

session_start();
if ($_SESSION['status'] != "login") {
    header("location:../login/login.php?pesan=belum_login");
}

// $data=mysqli_query($conn,"SELECT * FROM tbl_user WHERE username='' ");

// $user=mysqli_fetch_object($data);


if(isset($_POST['beli'])){
   
    $product_id = $_POST['product_id'];
    $gambar=$_POST['product_gambar'];
    $nama_menu = $_POST['product_name'];
    $harga = $_POST['product_price'];
    $jumlah = $_POST['quantity'];
    // echo $user->username;
    echo $nama_menu;
    echo $gambar;

    $tambah=mysqli_query($conn,"INSERT INTO tbl_pemesanan VALUES(null,'".$_SESSION['username']."','$nama_menu','$harga','$jumlah','$gambar')");

    if($tambah){
        echo "pemesanan berhasil";
    } else{
        echo "pemesanan gagal";
    }
}


$data_menu=mysqli_query($conn,"SELECT * FROM tbl_pemesanan WHERE user='".$_SESSION['username']."' ");


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemesanan</title>

    <link rel="stylesheet" href="css/pemesanan.css">
</head>
<body>
    <h2>Pesanan Anda</h2>

    <?php 

$subtotal=0;
?>
    <div class="card">
        <?php while($m=mysqli_fetch_assoc($data_menu)) : 
            $nama_pembeli=$m['user'];
            $menu=$m["name_menu"];
            $harga=$m["price_menu"];
            $jumlah=$m["qty"];

            $bayar=intval($harga) * intval($jumlah);
            $subtotal +=intval($bayar);
            ?>
        <p>Nama : <?php echo $nama_pembeli ?> </p>
        <p>Menu: <?php echo $menu ?></p>
        <p>Harga: <?php echo $harga ?></p>
        <p>Jumlah: <?php echo $jumlah ?></p>
        <p>Bayar: <?php echo $bayar ?></p>
        <p><?php echo $m['payment_status'] ?></p>
        
<hr>
        <?php endwhile; ?>

        <hr>
        <b>Sub Total: <?php echo  $subtotal ?> </b>

        <?php 
                $produk=mysqli_query($conn,"SELECT * FROM tbl_product");
                $p=mysqli_fetch_assoc($produk);

                $jumlahbaru=$p["stock"]-$jumlah;

                // echo $jumlahbaru;

                // $updatestockbaru=mysqli_query($conn,"UPDATE FROM tbl_product SET stock='$jumlahbaru' ");

        ?>
    </div>
</body>
</html>