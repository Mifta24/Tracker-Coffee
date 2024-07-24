<?php
session_start();
if ($_SESSION['status'] != "login") {
    header("location:../login.php?pesan=belum_login");
}

include '../database/db.php';

$user = mysqli_query($conn, "SELECT * FROM tbl_user");
include 'layout/header.php';
?>

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

</style>

<section class="user-list">
    <div class="container">
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
    </div>
</section>

<?php include 'layout/footer.php'; ?>
