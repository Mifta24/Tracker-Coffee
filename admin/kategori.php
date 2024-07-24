<!-- cek apakah sudah login -->
<?php
session_start();
include '../database/db.php';

if ($_SESSION['status'] != "login") {
  header("location:../login/login.php?pesan=belum_login");
};

include_once 'layout/header.php';
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
            $kategori = mysqli_query($conn, "SELECT * FROM tbl_category ORDER BY category_id");
            $i = 0;
            while ($row = mysqli_fetch_array($kategori)) :
              $i++;
            ?>
              <tr>
                <td><?php echo $i; ?></td>
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
    </div>
  </div>
</section>