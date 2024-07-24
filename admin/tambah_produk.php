<?php
// koneksi database
include '../database/db.php';

// Kondisi jika belum login
session_start();
if ($_SESSION['status'] != "login") {
    header("location:../login/login.php?pesan=belum_login");
}

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

/* Add Product Section */
.add-product {
    background-color: #ffffff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 20px;
    margin-top: 20px;
}

.add-product h2 {
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

<section class="add-product">
    <div class="container">
        <h2>Tambah Produk</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="menu">Kategori</label>
                <select name="menu" id="menu" class="form-control h-100" >
                    <?php
                    $kategori = mysqli_query($conn, "SELECT * FROM tbl_category ORDER BY category_id");
                    while ($row = mysqli_fetch_array($kategori)) :
                    ?>
                        <option value="<?php echo $row['category_id'] ?>">
                            <?php echo $row['category_name'] ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="nama_produk">Nama Produk</label>
                <input type="text" class="form-control" name="nama_produk" id="nama_produk" placeholder="Nama Produk">
            </div>

            <div class="form-group">
                <label for="harga">Harga</label>
                <input type="text" class="form-control" name="harga" id="harga" placeholder="Harga">
            </div>

            <div class="form-group">
                <label for="stok">Stok</label>
                <input type="text" class="form-control" name="stok" id="stok" placeholder="Stok">
            </div>

            <div class="form-group">
                <label for="gambar">Gambar</label>
                <input type="file" class="form-control h-100" name="gambar" id="gambar">
            </div>

            <div class="form-group">
                <label for="deskripsi">Deskripsi Produk</label>
                <textarea name="deskripsi" id="deskripsi" class="form-control" cols="30" rows="5" placeholder="Deskripsi Produk"></textarea>
            </div>

            <div class="form-group">
                <label for="status">Status Penjualan</label>
                <select name="status" id="status" class="form-control h-100">
                    <option value="">Pilih...</option>
                    <option value="1">On Sale</option>
                    <option value="0">Not For Sale</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary" name="submit" id="submit">Submit</button>
        </form>

        <?php
        if (isset($_POST['submit'])) {
            $kategori_menu = $_POST['menu'];
            $nama_produk = $_POST['nama_produk'];
            $harga = $_POST['harga'];
            $stok = $_POST['stok'];
            $deskripsi = $_POST['deskripsi'];
            $status = $_POST['status'];

            $filename = $_FILES['gambar']['name'];
            $tmpname = $_FILES['gambar']['tmp_name'];
            $type1 = explode('.', $filename);
            $type2 = $type1[1];
            $newimage = 'img' . time() . '.' . $type2;
            $tipefile = array("jpg", "jpeg", "png", "gif");

            if (!in_array($type2, $tipefile)) {
                echo "<script>alert('Format File Tidak Dizinkan');</script>";
            } else {
                if (move_uploaded_file($tmpname, '../img/coffee-menu/' . $newimage)) {
                    $insert = mysqli_query($conn, "INSERT INTO tbl_product VALUES(null,'$kategori_menu','$nama_produk','$harga','$stok','$deskripsi','$newimage','$status')");
                    if ($insert) {
                        echo "<script>alert('Tambah Produk Berhasil');window.location='produk.php'</script>";
                    } else {
                        echo "<script>alert('Input Gagal');</script>";
                    }
                } else {
                    echo "<script>alert('Upload Gambar Gagal');</script>";
                }
            }
        }
        ?>
    </div>
</section>

<?php
include 'layout/footer.php';
?>

<!-- CKEditor 5 -->
<script src="https://cdn.ckeditor.com/ckeditor5/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#deskripsi'))
        .catch(error => {
            console.error(error);
        });
</script>
