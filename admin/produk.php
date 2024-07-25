<?php
session_start();
include '../database/db.php';

if ($_SESSION['status'] != "login") {
  header("location:../login/login.php?pesan=belum_login");
}

// Define number of entries per page
$entries_per_page = 10;

// Determine the current page
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$current_page = max($current_page, 1);

// Calculate the offset
$offset = ($current_page - 1) * $entries_per_page;

// Get total number of products
if (isset($_GET['category'])) {
  $category = $_GET['category'];
  $total_entries_result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM tbl_product WHERE category_id = $category");
} else {
  $total_entries_result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM tbl_product");
}

$total_entries_row = mysqli_fetch_assoc($total_entries_result);
$total_entries = $total_entries_row['total'];

// Calculate total number of pages
$total_pages = ceil($total_entries / $entries_per_page);

// Retrieve the data for the current page
if (isset($_GET['category'])) {
  $category = $_GET['category'];
  $produk = mysqli_query($conn, "SELECT * FROM tbl_product LEFT JOIN tbl_category USING (category_id) WHERE category_id=$category ORDER BY category_id LIMIT $entries_per_page OFFSET $offset");
} else {
  $produk = mysqli_query($conn, "SELECT * FROM tbl_product LEFT JOIN tbl_category USING (category_id) ORDER BY category_id LIMIT $entries_per_page OFFSET $offset");
}

include 'layout/header.php';
?>

<style>
  .dashboard .box {
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    padding: 20px;
    margin-bottom: 20px;
  }

  .filter .filter-btn {
    margin: 5px;
    color: #343a40;
  }

  .filter .filter-btn:hover {
    text-decoration: none;
    background-color: #343a40;
    color: #fff;
  }

  table {
    width: 100%;
    margin-top: 20px;
  }

  .table th,
  .table td {
    text-align: center;
    vertical-align: middle;
  }

  footer {
    background-color: #343a40;
    color: white;
    padding: 20px 0;
    position: relative;
    bottom: 0;
    width: 100%;
  }

  .sosial a,
  .link a {
    color: white;
    margin: 0 10px;
  }

  .sosial a:hover,
  .link a:hover {
    color: #007bff;
    text-decoration: none;
  }

  .credit a {
    color: #007bff;
  }

  .pagination .page-item.active .page-link {
    background-color: #007bff;
    border-color: #007bff;
    color: white;
  }

  .pagination .page-link {
    color: #007bff;
  }

  .pagination .page-link:hover {
    color: #0056b3;
  }

  .pagination .page-item.disabled .page-link {
    color: #6c757d;
  }
</style>

<!-- Dashboard Start -->
<section class="dashboard">
  <div class="container">
    <div class="box">
      <h4 class="mb-4">Data Produk</h4>

      <!-- Filter -->
      <div class="filter mb-3">
        <a class="filter-btn btn btn-outline-dark" href="produk.php">All</a>
        <a class="filter-btn btn btn-outline-primary" href="produk.php?category=1">Coffee</a>
        <a class="filter-btn btn btn-outline-success" href="produk.php?category=2">Tea</a>
        <a class="filter-btn btn btn-outline-info" href="produk.php?category=3">Drink</a>
        <a class="filter-btn btn btn-outline-warning" href="produk.php?category=4">Food</a>
      </div>

      <!-- Add Product Button -->
      <a href="tambah_produk.php" class="btn btn-primary mb-3">Tambah Data</a>

      <!-- Table -->
      <div class="table-responsive">
        <table class="table table-striped table-hover">
          <thead class="thead-dark">
            <tr>
              <th>No</th>
              <th>Kategori</th>
              <th>Nama Produk</th>
              <th>Harga</th>
              <th>Stock</th>
              <th>Gambar</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $i = $offset + 1;
            while ($row = mysqli_fetch_array($produk)) :
            ?>
              <tr>
                <td><?php echo $i++; ?></td>
                <td><?php echo $row['category_name']; ?></td>
                <td><?php echo $row['product_name']; ?></td>
                <td><?php echo number_format($row['product_price'], 2, ',', '.'); ?></td>
                <td><?php echo $row['stock']; ?></td>
                <td>
                  <a href="../img/asset/menu/<?php echo $row['product_image']; ?>" target="_blank">
                    <img alt="<?php echo $row['product_image']; ?>" src="../img/asset/menu/<?php echo $row['product_image']; ?>" class="img-thumbnail" width="100px">
                  </a>
                </td>
                <td><?php echo ($row['product_status'] == 0) ? 'Not Sale' : 'For Sale'; ?></td>
                <td>
                  <a href="edit_produk.php?id=<?php echo $row['product_id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                  <a href="hapus_menu.php?idp=<?php echo $row['product_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini ?')">Hapus</a>
                </td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>

      <!-- Pagination -->
      <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
          <?php if ($current_page > 1): ?>
            <li class="page-item">
              <a class="page-link" href="?page=<?php echo $current_page - 1; ?>" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
              </a>
            </li>
          <?php endif; ?>

          <?php for ($page = 1; $page <= $total_pages; $page++): ?>
            <li class="page-item <?php echo ($page == $current_page) ? 'active' : ''; ?>">
              <a class="page-link" href="?page=<?php echo $page; ?>"><?php echo $page; ?></a>
            </li>
          <?php endfor; ?>

          <?php if ($current_page < $total_pages): ?>
            <li class="page-item">
              <a class="page-link" href="?page=<?php echo $current_page + 1; ?>" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
              </a>
            </li>
          <?php endif; ?>
        </ul>
      </nav>
    </div>
  </div>
</section>
<!-- Dashboard End -->

<?php include 'layout/footer.php'; ?>
