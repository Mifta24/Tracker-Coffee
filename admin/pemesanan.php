

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

      .table th, .table td {
        vertical-align: middle;
      }

      footer {
        background-color: #343a40;
        color: white;
        padding: 20px 0;
        position: fixed;
        bottom: 0;
        width: 100%;
      }

      .sosial a, .link a {
        color: white;
        margin: 0 10px;
      }

      .sosial a:hover, .link a:hover {
        color: #007bff;
        text-decoration: none;
      }

      .credit a {
        color: #007bff;
      }
    </style>
  </head>

  <body>
    <!-- Cek apakah sudah login -->
    <?php
    session_start();
    include '../database/db.php';
    if ($_SESSION['status'] != "login") {
      header("location:../login/login.php?pesan=belum_login");
    }

    include 'layout/header.php'
    ?>

    <section class="dashboard">
      <div class="container">
        <div class="box">

          <h4 class="mb-4">Daftar Pemesanan</h4>

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
                $pemesanan = mysqli_query($conn, "SELECT * FROM tbl_pemesanan");
                $i = 0;
                while ($row = mysqli_fetch_array($pemesanan)) :
                  $i++;
                ?>
                  <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $row['user']; ?></td>
                    <td><?php echo $row['name_menu']; ?></td>
                    <td><img class="img-thumbnail" width="60px" src="../img/coffee-menu/<?php echo $row['image_menu'] ?>" alt=""></td>
                    <td><?php echo number_format($row['price_menu'], 2, ',', '.'); ?></td>
                    <td><?php echo $row['qty']; ?></td>
                    <td><?php echo number_format($row['price_menu'] * $row['qty'], 2, ',', '.'); ?></td>
                    <td><?php echo ($row['payment_status']) == null ? 'Belum Dibayar' : 'Menunggu Konfirmasi'; ?></td>
                  </tr>
                <?php endwhile; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>

    <?php 
    
        include 'layout/footer.php';
    ?>
    <!-- Footer Start -->
    <footer class="text-center">
      <div class="container">
        <div class="sosial mb-3">
          <a target="_blank" href="https://twitter.com/MiftaAldi24?t=tGR24pLkyKmcJkHMb6NlwA&s=09"><i data-feather="twitter"></i></a>
          <a target="_blank" href="https://instagram.com/mifta_xh_ui?igshid=ZDdkNTZiNTM="><i data-feather="instagram"></i></a>
          <a target="_blank" href="https://github.com/Mifta24"><i data-feather="github"></i></a>
        </div>

        <div class="link mb-3">
          <a href="#home">Home</a>
          <a href="#about">Tentang Kami</a>
          <a href="#menu">Menu</a>
          <a href="#contact">Contact</a>
        </div>

        <div class="credit">
          <p>Created by <a href="">Miftahudin Aldi Saputra</a> | &copy; 2023.</p>
        </div>
      </div>
    </footer>
    <!-- Footer End -->

    <!-- Feather Icons -->
    <script>
      feather.replace();
    </script>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+Y+2Dh9T/xqPU9fUwE3DtK13UJh1j0CSrFvLRK7+4M/AKHP0Io/" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4. -->
