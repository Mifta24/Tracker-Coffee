<?php
// Mulai session untuk menyimpan keranjang belanja
session_start();


include '../database/db.php';


// Jika keranjang belanja kosong, buat keranjang belanja kosong
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// Jika ada data POST yang dikirimkan ke halaman ini, proses data tersebut
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $product_id = $_POST['product_id'];
    // echo $product_id;
    $product_image = $_POST['product_gambar'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $quantity = $_POST['quantity'];


    $_SESSION['name_product'] = $product_name;
    $name_menu=$_SESSION['name_product'];
    
    

    // echo $p->id;
    $pemesanan = mysqli_query($conn, "SELECT * FROM tbl_pemesanan WHERE name_menu='$product_name' AND user='". $_SESSION['username'] ."' ");
    $p = mysqli_fetch_object($pemesanan);
    
    // jika kondisi if tidak terpenuhi tidak ada erorr
    error_reporting(0);
    
    if($name_menu==$p->name_menu){
        // $id = $_SESSION['cart'][$product_id]['id'];
        $qtynew = $p->qty + $quantity;
        //  Update kuantitas produk dalam keranjang belanja
        // $_SESSION['cart'][$product_id]['quantity'] = $qtynew;
        
        // echo $qtynew;

        // update qty keranjang pada user
        mysqli_query($conn, "UPDATE tbl_pemesanan SET qty='$qtynew' WHERE name_menu='$product_name' AND user='". $_SESSION['username'] ."' ");

         // pengurangan stock product
         $produk = mysqli_query($conn, "SELECT * FROM tbl_product WHERE  product_id='" . $_SESSION['cart'][$product_id]['id'] . "'");
         $p = mysqli_fetch_assoc($produk);
 
         $jumlahbaru = $p["stock"] - $quantity;
         // echo $jumlahbaru;
 
         $updatestockbaru = mysqli_query($conn, "UPDATE tbl_product SET stock='$jumlahbaru' WHERE product_id='" . $_SESSION['cart'][$product_id]['id'] . "' ");
    }

    // // Jika produk sudah ada di keranjang belanja, tambahkan kuantitasnya
    // if (array_key_exists($p->name_menu, $_SESSION['cart'])) {

    //     $id = $_SESSION['cart'][$product_id]['id'];
    //     // echo $id;
    //     // $_SESSION['cart'][$product_id]['quantity'] += $quantity;


    //     $qtynew = $p->qty + $quantity;
    //     //  Update kuantitas produk dalam keranjang belanja
    //     $_SESSION['cart'][$product_id]['quantity'] = $qtynew;

    //      echo $qtynew;

    //     mysqli_query($conn, "UPDATE tbl_pemesanan SET qty='$qtynew' WHERE id=$id ");
    // }
     else {
        // Jika produk belum ada di keranjang belanja, tambahkan produk baru
        $_SESSION['cart'][$product_id] = array(
            'id' => $product_id,
            'image' => $product_image,
            'name' => $product_name,
            'price' => $product_price,
            'quantity' => $quantity
        );

        $sql = "INSERT INTO tbl_pemesanan VALUES(null, '" . $_SESSION['username'] . "', '" . $_SESSION['cart'][$product_id]['name'] . "', '" . $_SESSION['cart'][$product_id]['price'] . "', '" . $_SESSION['cart'][$product_id]['quantity'] . "', '" . $_SESSION['cart'][$product_id]['image'] . "',null)";
        mysqli_query($conn, $sql);

        // pengurangan stock product
        $produk = mysqli_query($conn, "SELECT * FROM tbl_product WHERE  product_id='" . $_SESSION['cart'][$product_id]['id'] . "' ");
        $p = mysqli_fetch_assoc($produk);

        $jumlahbaru = $p["stock"] - $_SESSION['cart'][$product_id]['quantity'];
        // echo $jumlahbaru;

        $updatestockbaru = mysqli_query($conn, "UPDATE tbl_product SET stock='$jumlahbaru' WHERE product_id='" . $_SESSION['cart'][$product_id]['id'] . "' ");
    }
}


// data pembayaran
$bayar = mysqli_query($conn, "SELECT * FROM tbl_pembayaran WHERE user='" . $_SESSION['username'] . "' ");

$b = mysqli_fetch_assoc($bayar);


// untuk cek status pada keranjang
$status = mysqli_query($conn, "SELECT * FROM tbl_pemesanan WHERE user='" . $_SESSION['username'] . "' ");

$s = mysqli_fetch_assoc($status);




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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,700;1,700&display=swap" rel="stylesheet">

    <!-- Feather Icons -->
    <script src="https://unpkg.com/feather-icons"></script>

</head>

<body>
    <!-- Shopping Cart start -->
    <div class="shopping-cart">
        <a class="back" href="user.php"><i data-feather="arrow-left"></i></a>
        <h3>Keranjang</h3>
        <p>Silahkan Checkout jika ingin membeli produk kami</p>
        <?php $menu = mysqli_query($conn, "SELECT * FROM tbl_pemesanan WHERE user='" . $_SESSION['username'] . "' ");

        $total_price = 0;
        while ($m = mysqli_fetch_assoc($menu)) :

            $image = $m['image_menu'];
            $name = $m['name_menu'];
            $price = $m['price_menu'];
            $quantity = $m['qty'];
            $subtotal = intval($price) * intval($quantity);
            $total_price += $subtotal;


        ?>

            <div class="cart-item">

                <img src="../img/coffee-menu/<?php echo $image ?>" alt="<?php echo $image ?>">

                <div class="item-detail">
                    <form action="update_menu.php?id=<?php echo $m['id'] ?>&qty=<?php echo $m['qty'] ?>&nmp=<?php echo $m['name_menu']?>" method="post">
                        <h3>
                            <?php echo htmlentities($name); ?>
                        </h3>

                        <div class="item-price">
                            <p>
                                Harga: Rp.<?php echo number_format($price)  ?>
                            </p>

                            <label for="qty">Jumlah: </label>

                            <!-- jika status sudah di beli qty tidak bisa di ubah -->
                            <?php if($s['payment_status']!= null ): ?>
                                <input type="number" name="qty" id="" value="<?php echo $quantity ?>" readonly>
                                <?php else : ?>
                            <input type="number" name="qty" id="" value="<?php echo $quantity ?>">
                            
                            <?php endif ?>
                            <p>Bayar:
                                Rp.<?php echo number_format($subtotal) ?>
                            </p>
                        </div>
                </div>

                <!-- jika sudah dibeli tidak bisa diedit maupun di hapus -->
                <?php if ($s['payment_status'] != null) : ?>
                    <button style="display: none;" type="button" name="submit"><i data-feather="check-circle" class="update-item"></i></button>
                    <a style="display: none;" href="hapus_keranjang.php?idm=<?php echo $m['id'] ?>"><i data-feather="trash-2" class="remove-item"></i></a>
                <?php else : ?>
                    <button type="submit" name="submit"><i data-feather="check-circle" class="update-item"></i></button>
                    </form>
                    <a href="hapus_keranjang.php?idm=<?php echo $m['id'] ?>&qty=<?php echo $m['qty'] ?>&nmp=<?php echo $m['name_menu']?>"><i data-feather="trash-2" class="remove-item"></i></a>
                <?php endif ?>
            </div>



        <?php endwhile; ?>

        <b>Total Pesanan:
            <?php echo "Rp." . number_format($total_price) ?>
        </b>

        <?php
        // total bayar
        $_SESSION['total'] = $total_price;

        // jika total bayarnya 0 tidak ditampilkan bayar sekarngnya
        if ($total_price > 0) :

            // jika payment status nya null tampilkan bayar sekarang
            if ($s['payment_status'] == null) :
        ?>
                <a class="bayar" href="../pembayaran/">Bayar Sekarang</a>

            <?php
            // sedangkan jika payment status nya ada isinya tampilkan isi sesuai database
            elseif ($s['payment_status'] != null) : ?>
                <a class="bayar" style="background-color: rgb(209, 172, 51);" href="#"><?php echo $s['payment_status'] ?></a>
            <?php endif ?>

        <?php endif ?>
    </div>
    <!-- Shopping Cart end -->


    <!-- Feather Icons -->
    <script>
        feather.replace()
    </script>
</body>

</html>