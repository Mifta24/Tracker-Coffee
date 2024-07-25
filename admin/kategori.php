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

// Get total number of categories
$total_entries_result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM tbl_category");
$total_entries_row = mysqli_fetch_assoc($total_entries_result);
$total_entries = $total_entries_row['total'];

// Calculate total number of pages
$total_pages = ceil($total_entries / $entries_per_page);

// Retrieve the data for the current page
$kategori = mysqli_query($conn, "SELECT * FROM tbl_category ORDER BY category_id LIMIT $entries_per_page OFFSET $offset");

include 'layout/header.php';
?>

<!-- CSS Kustom -->
<style>
  body {
    background-color: #f8f9fa;
  }

  .dashboard {
    margin-top: 20px;
    padding: 20px;
  }

  .box {
    background-color: white;
    border-radius: 5px;
    padding: 20px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  }

  .table {
    margin-top: 20px;
  }

  .btn {
    margin-bottom: 15px;
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

<section class="dashboard">
  <div class="container">
    <div class="box">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Kategori Menu</h4>
        <a class="btn btn-primary" href="tambah_data.php">
          <i class="fas fa-plus-circle"></i> Tambah Data
        </a>
      </div>
      <div class="table-responsive">
        <table class="table table-striped table-hover">
          <thead class="thead-dark">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Kategori Menu</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $i = $offset + 1;
            while ($row = mysqli_fetch_array($kategori)) :
            ?>
              <tr>
                <td><?php echo $i++; ?></td>
                <td><?php echo $row['category_name']; ?></td>
                <td>
                  <a href="edit_menu.php?id=<?php echo $row['category_id'] ?>" class="btn btn-sm btn-warning">
                    <i class="fas fa-edit"></i> Edit
                  </a>
                  <a href="hapus_menu.php?idk=<?php echo $row['category_id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data ini ?')">
                    <i class="fas fa-trash"></i> Hapus
                  </a>
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

<?php include_once 'layout/footer.php'; ?>
