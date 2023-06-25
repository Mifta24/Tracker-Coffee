    <!-- cek apakah sudah login -->
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
    ?>



    <!DOCTYPE html>
    <html lang="en">

    <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Produk</title>

      <!-- Fonts -->
      <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,700;1,700&display=swap" rel="stylesheet" />

      <!-- Feather Icons -->
      <script src="https://unpkg.com/feather-icons"></script>

      <link rel="stylesheet" href="css/penjualan.css">
    </head>

    <body>

      <header>
        <a href="index.php" target="_blank" class="logo">Tracker<span>coffee</span>.</a>
        <div class="nav">
          <a href="admin.php">Dashboard</a>
          <a href="profil.php">Profil</a>
          <a href="user.php">Data User</a>
          <a href="kategori.php">Data Kategori</a>
          <a href="produk.php">Data Produk</a>
          <a href="pemesanan.php">Data Pemesanan</a>
          <a href="penjualan.php">Data Penjualan</a>
        </div>

        <div class="navbar-extra">
          <a href="#" id="hamburger-menu"> <i data-feather="menu"></i></a>
          <a href="logout.php">LOGOUT</a>
        </div>
      </header>

      <section class="dashboard">
        <div class="box">

        <!-- Filter -->
          <div class="filter">
            <a class="filter-btn" href="penjualan.php">All</a>
            <a class="filter-btn" href="penjualan.php?status=Pembayaran Success">Pembayaran Success</a>
            <a class="filter-btn" href="penjualan.php?status=Menunggu Proses">Menunggu Proses</a>
          </div>

          <table id="payment" border="1" cellpadding=8 cellspacing="0" bordercolor="black">
            <thead>

              <tr>
                <td>No</td>
                <td>Nama Produk</td>
                <td>Nama Pembeli</td>
                <td style="width:130px; ">No Telp</td>
                <td style="width: 200px;">Alamat</td>
                <td>Catatan</td>
                <td>Metode Pembayaran</td>
                <td>Total Pesanan</td>
                <td>Bukti Pembayaran</td>
                <td>Status</td>
                <td>Action</td>

              </tr>
            </thead>
            <tbody>
              <?php

              $i = 0;
              while ($row = mysqli_fetch_array($pembayaran)) :
                $i++;
              ?>
                <tr>
                  <!-- No -->
                  <td><?php echo $i; ?></td>
                  <!-- Kategori Menu -->
                  <td><?php echo $row['menu']; ?></td>
                  <td><?php echo $row['user']; ?></td>
                  <!-- Nama Produk -->
                  <td style="width:130px;"><?php echo $row['telp']; ?></td>

                  <td style="width: 200px;"><?php echo $row['alamat'] ?></td>
                  <!-- Harga -->
                  <!-- Stock -->
                  <td><?php echo $row['catatan']; ?></td>
                  <!-- Gambar -->
                  <td>
                    <?php echo $row['metode_bayar'] ?>
                  </td>
                  <td>
                    <?php echo $row['total_pembayaran'] ?>
                  </td>
                  <td>
                    <a id="bukti" class="bukti" href="detail_bukti.php?id=<?php echo $row['id'] ?>"><img width="60px" height="60px" src="../img/bukti-pembayaran/<?php echo $row['bukti_pembayaran'] ?>" alt=""></a>
                  </td>
                  <td><?php echo $row['payment_status'] ?></td>
                  <!-- deskripsi dihapus -->

                  <!-- Aksi -->
                  <td style="display: flex; align-items:center; justify-content: center; ">

                    <?php if ($row['payment_status'] == "Pembayaran Success") : ?>
                      <p>Selesai</p>
                    <?php else : ?>
                      <!-- Setujui Pembayaran -->
                      <form action="transaksi_penjualan.php?id=<?php echo $row['id'] ?>" method="post">
                        <input type="hidden" name="payment_status" value="Pembayaran Success">
                        <button name="success">
                          <i data-feather="check" style="background-color:chartreuse ; color:white; font-weight: bold;"></i>
                        </button>
                      </form>

                      <!-- Tolak Pembayaran -->
                      <form action="transaksi_penjualan.php?idp=<?php echo $row['id'] ?>" method="post">
                        <input type="hidden" name="user" value="<?php echo $row['user'] ?>">
                        <button name="tolak" onclick="return confirm('Yakin ingin menghapus data ini ?')">
                          <i data-feather="x" style="background-color: red; color: white;"></i>
                        </button>
                      </form>

                    <?php endif; ?>

                  </td>
                </tr>
              <?php endwhile; ?>
            </tbody>
          </table>

        </div>
      </section>


      <!-- Fotter Start -->
      <footer>
        <div class="sosial">
          <a target="_blank" href="https://twitter.com/MiftaAldi24?t=tGR24pLkyKmcJkHMb6NlwA&s=09"><i data-feather="twitter"></i></a>
          <a target="_blank" href="https://instagram.com/mifta_xh_ui?igshid=ZDdkNTZiNTM="><i data-feather="instagram"></i></a>
          <a target="_blank" href="https://github.com/Mifta24"><i data-feather="github"></i></a>
        </div>

        <div class="link">
          <a href="#home">Home</a>
          <a href="#about">Tentang Kami</a>
          <a href="#menu">Menu</a>
          <a href="#contact">Contact</a>
        </div>

        <div class="credit">
          <p>Created by <a href="">Miftahudin Aldi Saputra</a>| &copy; 2023.</p>
        </div>
      </footer>
      <!-- Fotter End -->


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
    </body>

    </html>