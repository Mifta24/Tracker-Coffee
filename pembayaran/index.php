<?php

session_start();

include'../database/db.php';

$pesanan=mysqli_query($conn,"SELECT * FROM tbl_pemesanan WHERE user='" . $_SESSION['username'] . "'  ");

$user=mysqli_query($conn,"SELECT * FROM tbl_user WHERE username='" . $_SESSION['username'] . "' ");

$d_user=mysqli_fetch_assoc($user);

?>
<!DOCTYPE html>
<html ng-app="">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pembayaran</title>
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <script src="js/javascript.js" type="text/javascript"></script>
    <script src="js/angular-1.7.5/angular.min.js" type="text/javascript"></script>
  </head>
  <body>
  <div class="container">
    <h1 style="margin:10px;">PAYMENT</h1>
    <form class="" action="bayar.php" method="post">

      <input required class="input-form laf" type="text" name="name_user" value="<?php echo $d_user["username"]  ?>" placeholder="Nama">
      <input required class="input-form laf" type="text" name="no_telp" value="<?php echo $d_user["no_telp"]  ?>" placeholder="No telp">
      <textarea class="input-form" cols="5" rows="5" name="alamat" placeholder="Alamat"  required><?php echo $d_user["alamat"]  ?></textarea>


      <input type="text" style="background-color: black; color:white;" value="<?php while($p=mysqli_fetch_assoc($pesanan)): ?>
            <?php echo $p['name_menu'] .'='. $p['qty'] ?>
          <?php endwhile ?>" class="input-form" name="pesanan" id="" readonly required >
        

      <input readonly required class="input-form-value" type="text" name="total" value="<?php echo $_SESSION['total'] ?>" placeholder="<?php echo 'Rp.'.number_format( $_SESSION['total']) ?>" >

      <textarea class="input-form" cols="5" rows="5" name="comment" placeholder="Catatan"  required></textarea>

      <div style="overflow-x:auto;">
        <label>Pilih Metode Pembayaran</label>
        <table border=0 cellpadding="10">
          <!-- <tr>
            <th><input name="" type="checkbox"  value=""><img src="img/bni.png" width="60px" height="20px"></th>
            <th><input name="" type="checkbox"  value=""><img src="img/logo-bca.png" width="60px" height="20px"></th>
            <th><input name="" type="checkbox"  value=""><img src="img/bri.png" width="60px" height="25px"></th>
            <th><input name="" type="checkbox"  value=""><img src="img/bjb.png" width="60px" height="30px"></th>
            <th><input name="" type="checkbox"  value=""><img src="img/bankdki.png" width="60px" height="25px"></th>
            <th><input name="" type="checkbox"  value=""><img src="img/bankbb.png" width="60px" height="20px"></th>
          </tr> -->
          <tr style=" justify-content:center; width:auto; display: flex; background-color:cornsilk; ">
            <!-- <th><input name="" type="checkbox"  value=""><img src="img/visa.png" width="60px" height="30px"></th> -->
            <th style="align-items:center;  display: flex; margin-right:30px;"><input name="dana"  type="checkbox"  value="dana"><img src="img/dana-logo.png" width="60px" height="30px"></th>
            <th style="align-items:center; display: flex; margin-right:30px"><input name="gopay" type="checkbox"  value="gopay"><img src="img/gopay.jpg" width="65px" height="40px"></th>
            <th style="align-items:center; display: flex;margin-right:30px "><input name="ovo"   type="checkbox"  value="ovo"><img src="img/ovo-logo.jpeg" width="60px" height="30px"></th>
            <!-- <th><input name="" type="checkbox"  value=""><img src="img/alfa.jpg" width="70px" height="50px"></th>
            <th><input name="" type="checkbox"  value=""><img src="img/indomaret.png" width="60px" height="20px"></th> -->
          </tr>
        </table>
      </div>
      <button name="bayar" class="btn-form-pay">Pay</button>
      <a class="btn-form-change" id="myBtn" href="../user/keranjang1.php">Batal</a>
    </form>
  </div>

  <footer>
    <p style="color:gray; margin-top:10px; margin-left:10px;">Tracker Coffee</p>
  </footer>

  </body>
</html>
