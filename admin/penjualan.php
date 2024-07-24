<?php
session_start();
include '../database/db.php';
if ($_SESSION['status'] != "login") {
  header("location:../login/login.php?pesan=belum_login");
}

if (isset($_GET['status'])) {
  $status = $_GET['status'];
  $pembayaran = mysqli_query($conn, "SELECT * FROM tbl_pembayaran WHERE payment_status = '$status'");
} else {
  $pembayaran = mysqli_query($conn, "SELECT * FROM tbl_pembayaran");
}

include 'layout/header.php'
?>



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
    }

    .filter .filter-btn {
      margin: 5px;
      color: #343a40;
    }

    .filter .filter-btn:hover {
      text-decoration: none;
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
  </style>



    

      <!-- Dashboard Start -->
  <section class="dashboard">
    <div class="container">
      <div class="box">
        <h4 class="mb-4">Data Penjualan</h4>

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
              $i = 0;
              while ($row = mysqli_fetch_array($pembayaran)) :
                $i++;
              ?>
                <tr>
                  <td><?php echo $i; ?></td>
                  <td><?php echo $row['menu']; ?></td>
                  <td><?php echo $row['user']; ?></td>
                  <td><?php echo $row['telp']; ?></td>
                  <td><?php echo $row['alamat']; ?></td>
                  <td><?php echo $row['catatan']; ?></td>
                  <td><?php echo $row['metode_bayar']; ?></td>
                  <td><?php echo number_format($row['total_pembayaran'], 2, ',', '.'); ?></td>
                  <td>
                    <a id="bukti" class="bukti" href="detail_bukti.php?id=<?php echo $row['id']; ?>">
                      <img width="60px" height="60px" class="img-thumbnail" src="../img/bukti-pembayaran/<?php echo $row['bukti_pembayaran']; ?>" alt="Bukti Pembayaran">
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
                          <button name="success" class="btn btn-success btn-sm" title="Setujui Pembayaran">
                            <i data-feather="check"></i>
                          </button>
                        </form>
                        <!-- Tolak Pembayaran -->
                        <form action="transaksi_penjualan.php?idp=<?php echo $row['id']; ?>" method="post" style="display: inline;">
                          <input type="hidden" name="user" value="<?php echo $row['user']; ?>">
                          <button name="tolak" class="btn btn-danger btn-sm" title="Tolak Pembayaran" onclick="return confirm('Yakin ingin menghapus data ini ?')">
                            <i data-feather="x"></i>
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
      </div>
    </div>
  </section>
  <!-- Dashboard End -->


      


      <script src="../js/script.js"></script>

      <!-- Filterisasi Success Status -->
      <script>
        function filterByStatus(status) {
          var rows = document.querySelectorAll("#payment-table tbody tr");
          for (var i = 0; i < rows.length; i++) {
            var row = rows[i];
            var rowStatus = row.querySelector("td:last-child").textContent.trim();
            if (status === "success" && rowStatus === "Pembayaran Success") {
              row.style.display = "";
            } else if (status === "process" && rowStatus !== "Pembayaran Success") {
              row.style.display = "";
            } else {
              row.style.display = "none";
            }
          }
        }
      </script>


      <!-- Feather Icons -->
      <script>
        feather.replace();
      </script>
    
    <?php
    
        include 'layout/footer.php'
    ?>
    