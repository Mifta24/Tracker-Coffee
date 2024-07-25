<?php
session_start();
include '../database/db.php';

// Check if the user is logged in
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

// Check if there's a search query
$search_query = '';
if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
    $search_query = " WHERE user LIKE '%$search%' OR name_menu LIKE '%$search%' OR payment_status LIKE '%$search%'";
}

// Get total number of entries
$total_entries_result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM tbl_pemesanan $search_query");
$total_entries_row = mysqli_fetch_assoc($total_entries_result);
$total_entries = $total_entries_row['total'];

// Calculate total number of pages
$total_pages = ceil($total_entries / $entries_per_page);

// Retrieve the data for the current page
$pemesanan = mysqli_query($conn, "SELECT * FROM tbl_pemesanan $search_query LIMIT $entries_per_page OFFSET $offset");
?>

<?php include 'layout/header.php'; ?>


<style>
body {
  font-family: 'Poppins', sans-serif;
  background-color: #f8f9fa;
}

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

.search {
    margin-bottom: 20px;
}

.search form {
    display: flex;
    align-items: center;
}

.search input[type="text"] {
    width: 250px;
    padding: 8px;
    margin-right: 10px;
    border: 1px solid #ced4da;
    border-radius: 5px;
}

.search button {
    padding: 8px 20px;
}

</style>

<section class="dashboard">
    <div class="container">
        <div class="box">
            <h4 class="mb-4">Daftar Pemesanan</h4>

            <!-- Search Form (Aligned to the Right) -->
            <div class="d-flex justify-content-end mb-4">
                <form action="" method="GET" class="form-inline">
                    <input type="text" name="search" class="form-control mr-sm-2" placeholder="Search" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Pembeli</th>
                            <th scope="col">Nama Produk</th>
                            <th scope="col">Gambar Menu</th>
                            <th scope="col">Harga Menu</th>
                            <th scope="col">Jumlah Pemesanan</th>
                            <th scope="col">Harga Bayar / Menu</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = $offset + 1;
                        while ($row = mysqli_fetch_array($pemesanan)) :
                        ?>
                            <tr>
                                <td><?php echo $i++; ?></td>
                                <td><?php echo $row['user']; ?></td>
                                <td><?php echo $row['name_menu']; ?></td>
                                <td><img class="img-thumbnail" width="60px" src="../img/asset/menu/<?php echo $row['image_menu'] ?>" alt=""></td>
                                <td><?php echo number_format($row['price_menu'], 2, ',', '.'); ?></td>
                                <td><?php echo $row['qty']; ?></td>
                                <td><?php echo number_format($row['price_menu'] * $row['qty'], 2, ',', '.'); ?></td>
                                <td><?php echo ($row['payment_status']) == null ? 'Belum Dibayar' : 'Menunggu Konfirmasi'; ?></td>
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

<?php include 'layout/footer.php'; ?>






<!-- Feather Icons -->
<script>
    feather.replace();
</script>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+Y+2Dh9T/xqPU9fUwE3DtK13UJh1j0CSrFvLRK7+4M/AKHP0Io/" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
-->
