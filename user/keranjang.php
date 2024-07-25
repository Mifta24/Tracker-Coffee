<?php
session_start();
include '../database/db.php';

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = $_POST['product_id'];
    $product_image = $_POST['product_gambar'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $quantity = $_POST['quantity'];

    $_SESSION['name_product'] = $product_name;
    $name_menu = $_SESSION['name_product'];

    $pemesanan = mysqli_query($conn, "SELECT * FROM tbl_pemesanan WHERE name_menu='$product_name' AND user='" . $_SESSION['username'] . "' ");
    $p = mysqli_fetch_object($pemesanan);

    error_reporting(0);

    if ($name_menu == $p->name_menu) {
        $qtynew = $p->qty + $quantity;
        mysqli_query($conn, "UPDATE tbl_pemesanan SET qty='$qtynew' WHERE name_menu='$product_name' AND user='" . $_SESSION['username'] . "' ");

        $produk = mysqli_query($conn, "SELECT * FROM tbl_product WHERE  product_id='" . $_SESSION['cart'][$product_id]['id'] . "'");
        $p = mysqli_fetch_assoc($produk);

        $jumlahbaru = $p["stock"] - $quantity;
        $updatestockbaru = mysqli_query($conn, "UPDATE tbl_product SET stock='$jumlahbaru' WHERE product_id='" . $_SESSION['cart'][$product_id]['id'] . "' ");
    } else {
        $_SESSION['cart'][$product_id] = array(
            'id' => $product_id,
            'image' => $product_image,
            'name' => $product_name,
            'price' => $product_price,
            'quantity' => $quantity
        );

        $sql = "INSERT INTO tbl_pemesanan VALUES(null, '" . $_SESSION['username'] . "', '" . $_SESSION['cart'][$product_id]['name'] . "', '" . $_SESSION['cart'][$product_id]['price'] . "', '" . $_SESSION['cart'][$product_id]['quantity'] . "', '" . $_SESSION['cart'][$product_id]['image'] . "',null)";
        mysqli_query($conn, $sql);

        $produk = mysqli_query($conn, "SELECT * FROM tbl_product WHERE  product_id='" . $_SESSION['cart'][$product_id]['id'] . "' ");
        $p = mysqli_fetch_assoc($produk);

        $jumlahbaru = $p["stock"] - $_SESSION['cart'][$product_id]['quantity'];
        $updatestockbaru = mysqli_query($conn, "UPDATE tbl_product SET stock='$jumlahbaru' WHERE product_id='" . $_SESSION['cart'][$product_id]['id'] . "' ");
    }
}

$bayar = mysqli_query($conn, "SELECT * FROM tbl_pembayaran WHERE user='" . $_SESSION['username'] . "' ");
$b = mysqli_fetch_assoc($bayar);

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

    <!-- Bootstrap 4.1.3 CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/keranjang.css">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap" rel="stylesheet">

    <!-- Feather Icons -->
    <script src="https://unpkg.com/feather-icons"></script>
</head>

<body>
    <!-- Shopping Cart start -->
    <div class="container py-5">
        <a class="back text-muted" href="user.php"><i data-feather="arrow-left"></i> Kembali ke Toko</a>
        <h3 class="my-4 text-center">Keranjang Belanja</h3>
        <p class="text-center text-muted">Silahkan Checkout jika ingin membeli produk kami</p>

        <div class="row bg-light p-4">
            <?php
            $menu = mysqli_query($conn, "SELECT * FROM tbl_pemesanan WHERE user='" . $_SESSION['username'] . "' ");
            $total_price = 0;
            while ($m = mysqli_fetch_assoc($menu)) :

                $image = $m['image_menu'];
                $name = $m['name_menu'];
                $price = $m['price_menu'];
                $quantity = $m['qty'];
                $subtotal = intval($price) * intval($quantity);
                $total_price += $subtotal;
            ?>

                <div class="col-md-6 m-3">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                            <div class="media">
                                <img src="../img/asset/menu/<?php echo $image ?>" alt="<?php echo $image ?>" class="mr-3 img-fluid" style="width: 120px; height: 120px; border-radius: 8px;">
                                <div class="media-body text-dark">
                                    <h5 class="mt-0 "><?php echo htmlentities($name); ?></h5>
                                    <p class="mb-1">Harga: Rp.<?php echo number_format($price) ?></p>
                                    <form action="update_menu.php?id=<?php echo $m['id'] ?>&qty=<?php echo $m['qty'] ?>&nmp=<?php echo $m['name_menu'] ?>" method="post">
                                        <div class="form-inline">
                                            <label for="qty" class="mr-2">Jumlah:</label>
                                            <input type="number" name="qty" class="form-control mx-2" value="<?php echo $quantity ?>" <?php echo ($s['payment_status'] != null) ? 'readonly' : ''; ?>>
                                            <p class="mb-0">Subtotal: Rp.<?php echo number_format($subtotal) ?></p>
                                        </div>

                                </div>
                            </div>
                            <div class="mt-3">
                                <?php if ($s['payment_status'] == null) : ?>
                                    <button type="submit" name="submit" class="btn btn-success btn-sm"><i data-feather="check-circle"></i> Update</button>

                                    <a href="hapus_keranjang.php?idm=<?php echo $m['id'] ?>&qty=<?php echo $m['qty'] ?>&nmp=<?php echo $m['name_menu'] ?>" class="btn btn-danger btn-sm"><i data-feather="trash-2"></i> Remove</a>
                                <?php endif; ?>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>

            <?php endwhile; ?>

            <div class="col-12 text-right mt-4">
                <h4>Total Pesanan: Rp.<?php echo number_format($total_price) ?></h4>

                <?php
                $_SESSION['total'] = $total_price;

                if ($total_price > 0) {
                    if ($s['payment_status'] == null) {
                        echo '<a class="btn btn-primary mt-3" href="../pembayaran/">Bayar Sekarang</a>';
                    } else {
                        echo '<a class="btn btn-warning mt-3" href="#">' . $s['payment_status'] . '</a>';
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <!-- Shopping Cart end -->

    <!-- Feather Icons -->
    <script>
        feather.replace()
    </script>

    <!-- Bootstrap 4.1.3 JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</body>

</html>