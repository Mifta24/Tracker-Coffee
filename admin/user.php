<?php
session_start();
if ($_SESSION['status'] != "login") {
    header("location:../login.php?pesan=belum_login");
}

include '../database/db.php';

// Pagination setup
$records_per_page = 10; // Number of records per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $records_per_page;

// Search functionality
$search_query = "";
if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
    $search_query = "WHERE username LIKE '%$search%' OR name_user LIKE '%$search%' OR no_telp LIKE '%$search%' OR alamat LIKE '%$search%'";
}

// Get total number of records
$total_query = mysqli_query($conn, "SELECT COUNT(*) AS total FROM tbl_user $search_query");
$total_records = mysqli_fetch_assoc($total_query)['total'];
$total_pages = ceil($total_records / $records_per_page);

// Get records for the current page
$user_query = "SELECT * FROM tbl_user $search_query LIMIT $offset, $records_per_page";
$user = mysqli_query($conn, $user_query);

include 'layout/header.php';
?>

<!-- CSS Kustom -->
<style>
  /* User List Styles */
  .user-list {
      padding: 20px;
      background-color: #f4f4f4;
  }

  .container {
      max-width: 1200px;
      margin: 0 auto;
  }

  .card {
      background-color: #ffffff;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      margin-bottom: 20px;
      padding: 20px;
  }

  .card-header {
      display: flex;
      justify-content: center;
      margin-bottom: 10px;
  }

  .card-header h3 {
      font-size: 2rem;
      color: #007bff;
  }

  .card-body {
      display: flex;
      flex-wrap: wrap;
  }

  .row {
      display: flex;
      margin-bottom: 15px;
  }

  .col {
      flex: 1;
      min-width: 200px;
      margin-right: 20px;
  }

  h4 {
      font-size: 1.2rem;
      color: #333;
      margin-bottom: 5px;
  }

  p {
      font-size: 1rem;
      color: #666;
      margin: 0;
  }

  /* Pagination Styles */
  .pagination {
      display: flex;
      justify-content: center;
      margin-top: 20px;
  }

  .pagination a {
      padding: 10px 15px;
      margin: 0 5px;
      border: 1px solid #ddd;
      border-radius: 5px;
      color: #007bff;
      text-decoration: none;
  }

  .pagination a.active {
      background-color: #007bff;
      color: #fff;
      border: 1px solid #007bff;
  }

  .pagination a:hover {
      background-color: #f1f1f1;
  }
</style>

<section class="user-list">
    <div class="container">
        <!-- Search Form -->
        <div class="search mb-4">
            <form method="get" action="" class="">
                <input type="text" name="search"  class="h-100" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>" placeholder="Search users...">
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </div>

        <?php while ($u = mysqli_fetch_assoc($user)): ?>
            <div class="card">
                <div class="card-header">
                    <h3><i data-feather="user"></i></h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h4>Username</h4>
                            <p><?php echo htmlspecialchars($u['username']); ?></p>
                        </div>
                        <div class="col">
                            <h4>Nama</h4>
                            <p><?php echo htmlspecialchars($u['name_user']); ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <h4>No Telp</h4>
                            <p><?php echo htmlspecialchars($u['no_telp']); ?></p>
                        </div>
                        <div class="col">
                            <h4>Alamat</h4>
                            <p><?php echo htmlspecialchars($u['alamat']); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
        
        <!-- Pagination Links -->
        <div class="pagination">
            <?php if ($page > 1): ?>
                <a href="?page=<?php echo $page - 1; ?><?= isset($_GET['search']) ? '&search=' . urlencode($_GET['search']) : ''; ?>">&laquo; Prev</a>
            <?php endif; ?>
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <a href="?page=<?php echo $i; ?><?= isset($_GET['search']) ? '&search=' . urlencode($_GET['search']) : ''; ?>" class="<?php echo $i == $page ? 'active' : ''; ?>">
                    <?php echo $i; ?>
                </a>
            <?php endfor; ?>
            <?php if ($page < $total_pages): ?>
                <a href="?page=<?php echo $page + 1; ?><?= isset($_GET['search']) ? '&search=' . urlencode($_GET['search']) : ''; ?>">Next &raquo;</a>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php include 'layout/footer.php'; ?>
