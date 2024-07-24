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

	// $katDibeli=mysqli_query($conn,"SELECT * FROM tbl_pembayaran WHERE category ");


	?>

	<?php 
	
		include_once 'layout/header.php';
	?>
    <body>

    	<!-- <header>
    		<a href="index.html" class="logo">Tracker<span>coffee</span>.</a>
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
    	</header> -->

    	<section class="dashboard">
    		<h3>Dashboard</h3>
    		<div class="box">
    			<h3>Selamat Datang Admin</h3>
    			<p>Ini Adalah halaman untuk mengatur website user dari Tracker Coffee</p>

    			<div class="row">
    				<div class="col-lg-3 col-md-6">
    					<div class="card text-light bg-flat-color-2  p-md-2">
    						<div class="card-body">
    							<div class="stat-widget-four">
    								<div class="stat-icon dib">
    									<i class="ti-user text-white"></i>

    								</div>
    								<div class="stat-content ">
    									<div class="text-center dib">
    										<div class="stat-heading">Users</div>
    										<div class="stat-digit"><?php echo $jumUser ?></div>
    									</div>
    								</div>
    							</div>
    						</div>
    					</div>
    				</div>

    				<div class="col-lg-3 col-md-6">
    					<div class="card ">
    						<div class="card-body">
    							<div class="stat-widget-one">
    								<div class="stat-icon dib"><i class="ti-layout-grid2 text-warning border-warning"></i></div>
    								<div class="stat-content dib">
    									<div class="stat-heading">Produk</div>
    									<div class="stat-digit"><?php echo $jumProduk ?></div>
    								</div>
    							</div>
    						</div>
    					</div>
    				</div>

    				<div class="col-sm-6 col-lg-3">
    					<div class="card text-white bg-flat-color-3 h-75">
    						<div class="card-body">
    							<div class="card-left pt-1 float-left ">
    								<h3 class="mb-0 fw-r">
    									<span class="currency float-left mr-1"></span>
    									<span class="count"><?php echo $jumPenjualan ?></span>
    								</h3>
    								<p class="text-light mt-1 m-0">Terjual</p>
    							</div><!-- /.card-left -->

    							<div class="card-right float-right text-right">
    								<i class="icon fade-5 icon-lg pe-7s-cart"></i>
    							</div><!-- /.card-right -->

    						</div>

    					</div>
    				</div>

    				<div class="col-lg-3 col-md-6">
    					<div class="card">
    						<div class="card-body">
    							<div class="stat-widget-one">
    								<div class="stat-icon dib"><i class="ti-money text-success border-success"></i></div>
    								<div class="stat-content dib">
    									<div class="stat-text">Total Profit</div>
    									<div class="stat-digit"><?php echo $total['total'] ?></div>
    								</div>
    							</div>
    						</div>
    					</div>
    				</div>
    			</div>

    			<div class="row">

    				<div class="col-lg-5 ml-5 mr-lg-5">
    					<div class="card ">
    						<div class="card-body">
    							<h4 class="mb-3">Menu Chart</h4>
    							<div class="chart-container">
    								<canvas id="pie-chart"></canvas>
    							</div>
    						</div>
    					</div>
    				</div>


    				<div class="col-md-5 ml-lg-5">
    					<div class="card ">
    						<div class="card-header">
    							<i class="fa fa-user"></i><strong class="card-title pl-2">Profile Card</strong>
    						</div>
    						<div class="card-body">
    							<div class="mx-auto d-block">
    								<img width="250px" class="rounded-circle mx-auto d-block" src="../img/profil/<?php echo $adminname['admin_image']?>" alt="<?php echo $adminname['admin_name'] ?>">
    								<h5 class="text-sm-center mt-2 mb-1"><?php echo $adminname['admin_name'] ?></h5>
    								<div class="location text-sm-center"><i class="fa fa-map-marker"></i><?php echo $adminname['admin_address'] ?></div>
    							</div>
    							<hr>
    							<div class="card-text text-sm-center">
    								<a href="#"><i class="fa fa-facebook pr-1"></i></a>
    								<a href="#"><i class="fa fa-twitter pr-1"></i></a>
    								<a href="#"><i class="fa fa-linkedin pr-1"></i></a>
    								<a href="#"><i class="fa fa-pinterest pr-1"></i></a>
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
		
		$coffee=mysqli_query($conn,"SELECT * FROM tbl_product WHERE category_id=1");
		$jumCoffee=mysqli_num_rows($coffee);
		$tea=mysqli_query($conn,"SELECT * FROM tbl_product WHERE category_id=2");
		$jumTea=mysqli_num_rows($tea);
		$drink=mysqli_query($conn,"SELECT * FROM tbl_product WHERE category_id=3");
		$jumDrink=mysqli_num_rows($drink);
		$food=mysqli_query($conn,"SELECT * FROM tbl_product WHERE category_id=4");
		$jumFood=mysqli_num_rows($food);
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

    	




    </body>

    </html>