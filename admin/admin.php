<!-- cek apakah sudah login -->
<?php
session_start();

include "../database/db.php";
if ($_SESSION['status'] != "login") {
    header("location:../login.php?pesan=belum_login");
}

$user = mysqli_query($conn, "SELECT * FROM tbl_user");
$jumUser = mysqli_num_rows($user);

$produk = mysqli_query($conn, "SELECT * FROM tbl_product");
$jumProduk = mysqli_num_rows($produk);

$penjualan = mysqli_query($conn, "SELECT  * FROM tbl_pembayaran");
$jumPenjualan = mysqli_num_rows($penjualan);
$penjualanTotal = mysqli_query($conn, "SELECT SUM(total_pembayaran) AS total FROM tbl_pembayaran");
$total = mysqli_fetch_assoc($penjualanTotal);

$admin = mysqli_query($conn, "SELECT * FROM tbl_admin");
$adminname = mysqli_fetch_assoc($admin);

?>

<?php
include_once 'layout/header.php';
?>

<body>
   
    <!-- Dashboard Section -->
    <section class="dashboard py-5">
        <div class="container">
            <h3 class="mb-4 text-center">Admin Dashboard</h3>
            <div class="alert alert-info text-center" role="alert">
                Selamat Datang Admin! Ini adalah halaman untuk mengatur website user dari Cateringku.
            </div>

            <div class="row">
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card text-white bg-primary">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <i class="ti-user fa-2x"></i>
                                </div>
                                <div>
                                    <h5 class="card-title">Users</h5>
                                    <p class="card-text"><?php echo $jumUser ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card text-white bg-success">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <i class="ti-layout-grid2 fa-2x"></i>
                                </div>
                                <div>
                                    <h5 class="card-title">Produk</h5>
                                    <p class="card-text"><?php echo $jumProduk ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card text-white bg-warning">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <i class="ti-money fa-2x"></i>
                                </div>
                                <div>
                                    <h5 class="card-title">Terjual</h5>
                                    <p class="card-text"><?php echo $jumPenjualan ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card text-white bg-danger">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <i class="ti-wallet fa-2x"></i>
                                </div>
                                <div>
                                    <h5 class="card-title">Total Profit</h5>
                                    <p class="card-text"><?php echo 'Rp ' . number_format($total['total']) ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-3">Menu Chart</h4>
                            <div class="chart-container">
                                <canvas id="pie-chart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Profile Card</strong>
                        </div>
                        <div class="card-body">
                            <div class="text-center">
                                <img width="150px" class="rounded-circle mb-3" src="../img/asset/profil/<?php echo $adminname['admin_image'] ?>" alt="<?php echo $adminname['admin_name'] ?>">
                                <h5 class="card-title"><?php echo $adminname['admin_name'] ?></h5>
                                <p class="card-text"><i class="fa fa-map-marker"></i> <?php echo $adminname['admin_address'] ?></p>
                                <div>
                                    <a href="#"><i class="fa fa-facebook pr-1"></i></a>
                                    <a href="#"><i class="fa fa-twitter pr-1"></i></a>
                                    <a href="#"><i class="fa fa-linkedin pr-1"></i></a>
                                    <a href="#"><i class="fa fa-pinterest pr-1"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php
    include_once 'layout/footer.php';
    ?>

    <!-- Pie ChartJs -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Pie chart data -->
    <?php

    $coffee = mysqli_query($conn, "SELECT * FROM tbl_product WHERE category_id=1");
    $jumCoffee = mysqli_num_rows($coffee);
    $tea = mysqli_query($conn, "SELECT * FROM tbl_product WHERE category_id=2");
    $jumTea = mysqli_num_rows($tea);
    $drink = mysqli_query($conn, "SELECT * FROM tbl_product WHERE category_id=3");
    $jumDrink = mysqli_num_rows($drink);
    $food = mysqli_query($conn, "SELECT * FROM tbl_product WHERE category_id=4");
    $jumFood = mysqli_num_rows($food);
    ?>
    <!-- Chart JS -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Data untuk grafik
            var data = {
                labels: ["Coffee", "Tea", "Drink", "Food"],
                datasets: [{
                    data: [<?php echo $jumCoffee ?>, <?php echo $jumTea ?>, <?php echo $jumDrink ?>, <?php echo $jumFood ?>],
                    backgroundColor: ["#bb6a00", "#e97600", "#9ec155", "#ebc63b"]
                }]
            };

            // Opsi konfigurasi untuk grafik
            var options = {
                responsive: true
            };

            // Mendapatkan elemen canvas grafik
            var canvas = document.getElementById("pie-chart");

            // Membuat grafik pie
            var ctx = canvas.getContext("2d");
            var pieChart = new Chart(ctx, {
                type: 'pie',
                data: data,
                options: options
            });
        });
    </script>

    <!-- Feather Icons -->
    <script>
        feather.replace();
    </script>

    