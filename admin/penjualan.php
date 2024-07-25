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

  // Check if there's a search query
  $search_query = '';
  if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
    $search_query = " AND (kd_bayar LIKE '%$search%' OR menu LIKE '%$search%' OR user LIKE '%$search%')";
  }

  // Get total number of entries
  if (isset($_GET['status'])) {
    $status = $_GET['status'];
    $total_entries_result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM tbl_pembayaran WHERE payment_status = '$status' $search_query");
  } else {
    $total_entries_result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM tbl_pembayaran WHERE 1 $search_query");
  }

  $total_entries_row = mysqli_fetch_assoc($total_entries_result);
  $total_entries = $total_entries_row['total'];

  // Calculate total number of pages
  $total_pages = ceil($total_entries / $entries_per_page);

  // Retrieve the data for the current page
  if (isset($_GET['status'])) {
    $pembayaran = mysqli_query($conn, "SELECT * FROM tbl_pembayaran WHERE payment_status = '$status' $search_query LIMIT $entries_per_page OFFSET $offset");
  } else {
    $pembayaran = mysqli_query($conn, "SELECT * FROM tbl_pembayaran WHERE 1 $search_query LIMIT $entries_per_page OFFSET $offset");
  }

  include 'layout/header.php';
  ?> <style>
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

  <!-- Dashboard Start -->
  <section class="dashboard">
    <div class="container">
      <div class="box">
        <h4 class="mb-4">Data Penjualan</h4>

        <!-- Search Form (Aligned to the Right) -->
        <div class="d-flex justify-content-end mb-4">
          <form action="penjualan.php" method="GET" class="form-inline">
            <input type="text" name="search" class="form-control mr-sm-2" placeholder="Search" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
            <button type="submit" class="btn btn-primary">Search</button>
          </form>
        </div>


        <!-- Filter -->
        <div class="filter mb-3">
          <a class="filter-btn btn btn-outline-dark" href="penjualan.php">All</a>
          <a class="filter-btn btn btn-outline-success" href="penjualan.php?status=Pembayaran Success">Pembayaran Success</a>
          <a class="filter-btn btn btn-outline-warning" href="penjualan.php?status=Menunggu Proses">Menunggu Proses</a>
        </div>

        <!-- Table -->
        <div class="table-responsive">
          <table id="payment" class="table table-striped table-hover">
            <thead class="thead-dark">
              <tr>
                <th>No</th>
                <th>Kode Bayar</th>
                <th>Nama Produk</th>
                <th>Nama Pembeli</th>
                <th>No Telp</th>
                <th>Alamat</th>
                <th>Catatan</th>
                <th>Metode Pembayaran</th>
                <th>Total Pesanan</th>
                <th>Bukti Pembayaran</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $i = $offset + 1;
              while ($row = mysqli_fetch_array($pembayaran)) :
              ?>
                <tr>
                  <td><?php echo $i++; ?></td>
                  <td><?php echo $row['kd_bayar']; ?></td>
                  <td><?php echo $row['menu']; ?></td>
                  <td><?php echo $row['user']; ?></td>
                  <td><?php echo $row['telp']; ?></td>
                  <td><?php echo $row['alamat']; ?></td>
                  <td><?php echo $row['catatan']; ?></td>
                  <td><?php echo $row['metode_bayar']; ?></td>
                  <td><?php echo number_format($row['total_pembayaran'], 2, ',', '.'); ?></td>
                  <td>
                    <a id="bukti" class="bukti" href="detail_bukti.php?id=<?php echo $row['id']; ?>">
                      <img width="60px" height="60px" class="img-thumbnail" src="../img/asset/bukti-pembayaran/<?php echo $row['bukti_pembayaran']; ?>" alt="Bukti Pembayaran">
                    </a>
                  </td>
                  <td><?php echo $row['payment_status']; ?></td>
                  <td>
                    <div class="d-flex justify-content-center align-items-center">
                      <?php if ($row['payment_status'] == "Pembayaran Success") : ?>
                        <span class="badge badge-success">Selesai</span>
                      <?php else : ?>
                        <!-- Setujui Pembayaran -->
                        <form action="transaksi_penjualan.php?id=<?php echo $row['id']; ?>" method="post" style="display: inline;">
                          <input type="hidden" name="payment_status" value="Pembayaran Success">
                          <button name="success" class="btn btn-success btn-sm">
                            <i data-feather="check"></i> Accept
                          </button>
                        </form>
                        <!-- Tolak Pembayaran -->
                        <form action="transaksi_penjualan.php?idp=<?php echo $row['id']; ?>" method="post" style="display: inline;">
                          <input type="hidden" name="user" value="<?php echo $row['user']; ?>">
                          <button name="tolak" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini ?')">
                            <i data-feather="x"></i> Reject
                          </button>
                        </form>
                      <?php endif; ?>
                    </div>
                  </td>
                </tr>
              <?php endwhile; ?>
            </tbody>
          </table>
        </div>

        <!-- Pagination -->
        <nav aria-label="Page navigation">
          <ul class="pagination justify-content-center">
            <?php if ($current_page > 1) : ?>
              <li class="page-item">
                <a class="page-link" href="?page=<?php echo $current_page - 1; ?>" aria-label="Previous">
                  <span aria-hidden="true">&laquo;</span>
                </a>
              </li>
            <?php endif; ?>

            <?php for ($page = 1; $page <= $total_pages; $page++) : ?>
              <li class="page-item <?php echo ($page == $current_page) ? 'active' : ''; ?>">
                <a class="page-link" href="?page=<?php echo $page; ?>"><?php echo $page; ?></a>
              </li>
            <?php endfor; ?>

            <?php if ($current_page < $total_pages) : ?>
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

  <script src="../js/script.js"></script>

  <!-- Feather Icons -->
  <script>
    feather.replace();
  </script>

  <?php include 'layout/footer.php'; ?>