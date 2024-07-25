<?php
session_start();
include '../database/db.php';

// Redirect to login if not logged in
if ($_SESSION['status'] != "login") {
    header("location:../login/login.php?pesan=belum_login");
}

// Fetch product data
$produk = mysqli_query($conn, "SELECT * FROM tbl_product WHERE product_id='" . $_GET['id'] . "'");
$p = mysqli_fetch_object($produk);

include 'layout/header.php';
?>

<style>
  /* General Styles */
body {
    font-family: 'Poppins', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
}

.container {
    max-width: 900px;
    margin: 0 auto;
    padding: 20px;
}

/* Edit Product Section */
.edit-product {
    background-color: #ffffff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 20px;
    margin-top: 20px;
}

.edit-product h2 {
    font-size: 28px;
    margin-bottom: 20px;
    color: #333;
}

.form-group {
    margin-bottom: 15px;
}

.form-group label {
    display: block;
    font-weight: 600;
    margin-bottom: 5px;
    color: #333;
}

.form-control {
    width: 100%;
    padding: 10px;
    border: 1px solid #ced4da;
    border-radius: 4px;
    box-sizing: border-box;
}

.form-control:focus {
    border-color: #007bff;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

.btn-primary {
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 10px 20px;
    font-size: 16px;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.btn-primary:hover {
    background-color: #0056b3;
}

</style>

<section class="edit-product">
    <div class="container">
        <h2>Edit Produk</h2>

        <form action="" method="post" enctype="multipart/form-data">
            <!-- Category -->
            <div class="form-group">
                <label for="menu">Kategori</label>
                <select name="menu" id="menu" class="form-control h-100">
                    <?php
                    $kategori = mysqli_query($conn, "SELECT * FROM tbl_category ORDER BY category_id");
                    while ($row = mysqli_fetch_array($kategori)) :
                    ?>
                        <option value="<?php echo $row['category_id']; ?>" <?php echo ($row['category_id'] == $p->category_id) ? 'selected' : ''; ?>>
                            <?php echo $row['category_name']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <!-- Product Name -->
            <div class="form-group">
                <label for="nama_produk">Nama Produk</label>
                <input type="text" class="form-control" name="nama_produk" id="nama_produk" placeholder="Nama Produk" value="<?php echo $p->product_name; ?>">
            </div>

            <!-- Price -->
            <div class="form-group">
                <label for="harga">Harga</label>
                <input type="text" class="form-control" name="harga" id="harga" placeholder="Harga" value="<?php echo $p->product_price; ?>">
            </div>

            <!-- Stock -->
            <div class="form-group">
                <label for="stok">Stok</label>
                <input type="text" class="form-control" name="stok" id="stok" placeholder="Stok" value="<?php echo $p->stock; ?>">
            </div>

            <!-- Old Image -->
            <input type="hidden" name="foto" value="<?php echo $p->product_image; ?>">
            <div class="form-group">
                <label for="gambar">Gambar Lama</label>
                <img src="../img/asset/menu/<?php echo $p->product_image; ?>" width="100px" alt="Gambar Produk">
            </div>

            <!-- New Image -->
            <div class="form-group">
                <label for="gambar">Gambar Baru (Opsional)</label>
                <input type="file" name="gambar" id="gambar" class="form-control h-100">
            </div>

            <!-- Description -->
            <div class="form-group">
                <label for="deskripsi">Deskripsi Produk</label>
                <textarea name="deskripsi" id="deskripsi" cols="30" rows="5" class="form-control"><?php echo $p->product_description; ?></textarea>
            </div>

            <!-- Status -->
            <div class="form-group">
                <label for="status">Status Penjualan</label>
                <select name="status" id="status" class="form-control h-100">
                    <option value="">Pilih...</option>
                    <option value="1" <?php echo ($p->product_status == 1) ? 'selected' : ''; ?>>On Sale</option>
                    <option value="0" <?php echo ($p->product_status == 0) ? 'selected' : ''; ?>>Not For Sale</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary" name="submit" id="submit">Update</button>
        </form>

        <?php
        include 'layout/footer.php';

        if (isset($_POST['submit'])) {
            // Collect form data
            $kategori_menu = $_POST['menu'];
            $nama_produk = $_POST['nama_produk'];
            $harga = $_POST['harga'];
            $stok = $_POST['stok'];
            $deskripsi = $_POST['deskripsi'];
            $status = $_POST['status'];
            $fotoLama = $_POST['foto'];
            $filename = $_FILES['gambar']['name'];
            $tmpname = $_FILES['gambar']['tmp_name'];

            // Process new image if uploaded
            if ($filename != '') {
                $type1 = explode('.', $filename);
                $type2 = end($type1);
                $newimage = 'img' . time() . '.' . $type2;
                $tipefile = array("jpg", "jpeg", "png", "gif");

                if (!in_array($type2, $tipefile)) {
                    echo "<script>alert('Format File Tidak Dizinkan');</script>";
                } else {
                    unlink("../img/coffee-menu/" . $fotoLama);
                    if (move_uploaded_file($tmpname, '../img/asset/menu/' . $newimage)) {
                        $nama_gambar = $newimage;
                    } else {
                        $nama_gambar = $fotoLama;
                    }
                }
            } else {
                $nama_gambar = $fotoLama;
            }

            // Update product details
            $update = mysqli_query($conn, "UPDATE tbl_product SET 
                                            category_id='$kategori_menu',
                                            product_name='$nama_produk',
                                            product_price='$harga',
                                            stock='$stok',
                                            product_image='$nama_gambar',
                                            product_description='$deskripsi',
                                            product_status='$status'
                                            WHERE product_id='$p->product_id'");

            if ($update) {
                echo "<script>window.location='produk.php';</script>";
            } else {
                echo "<script>alert('Update Gagal');</script>";
            }
        }
        ?>
    </div>
</section>

<!-- CKEditor 5 -->
<script src="https://cdn.ckeditor.com/ckeditor5/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#deskripsi'))
        .catch(error => {
            console.error(error);
        });
</script>
