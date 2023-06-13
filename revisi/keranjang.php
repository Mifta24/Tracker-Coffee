<?php
session_start();

$pdo=require_once '../database/db.php';
$sql='SELECT * FROM tbl_product WHERE id in(';
$idProduk=array_keys($_SESSION['keranjang']);
$sql .=trim(str_repeat('?,',count($idProduk)), ',');
$sql=')';

$query=$pdo->prepare($sql);
$query->execute($idProduk);




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang</title>

    <link rel="stylesheet" href="css/keranjang.css">

    <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,700;1,700&display=swap"
    rel="stylesheet">

  <!-- Feather Icons -->
  <script src="https://unpkg.com/feather-icons"></script>

</head>
<body>
    <!-- Shopping Cart start -->
    <div class="shopping-cart">
        <h3>Keranjang</h3>
        <p>Silahkan Checkout jika ingin membeli produk kami</p>

      <?php 
        while($produk=$query->fetch()){
      ?>
      <div class="cart-item">
        <img src="../img/coffee-icon.png
        " alt="Product 1">
        <div class="item-detail">
          <h3><?php echo htmlentities($produk['product_name']); ?> 1</h3>
          <div class="item-price">IDR 30K</div>
          <input type="number" name="" id="">
        </div>
        <i data-feather="trash-2" class="remove-item"></i>
      </div>
          <?php } ?>

    </div>
    <!-- Shopping Cart end -->


    
  <!-- Feather Icons -->
  <script>
    feather.replace()
  </script>
</body>
</html>