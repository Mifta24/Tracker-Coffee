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

    <!DOCTYPE html>
    <html lang="en">

    <head>
    	<meta charset="UTF-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    	<title>Dashboard</title>

    	<!-- Bootsrap -->
    	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    	<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    	<link rel="stylesheet" href="../assets/css/cs-skin-elastic.css">
    	<link rel="stylesheet" href="../assets/css/style.css">

    	<link href="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.css" rel="stylesheet">
    	<link href="https://cdn.jsdelivr.net/npm/jqvmap@1.5.1/dist/jqvmap.min.css" rel="stylesheet">

    	<!-- Fonts -->
    	<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,700;1,700&display=swap" rel="stylesheet" />

    	<!-- Feather Icons -->
    	<script src="https://unpkg.com/feather-icons"></script>


    	<link rel="stylesheet" href="css/admin.css">
    </head>

    <body>

    	<header>
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
    	</header>

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

    	<!-- Scripts bootstrap -->
    	<script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    	<script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    	<script src="../assets/js/main.js"></script>
    	<!--  Chart js -->
    	<!-- <script src="https://cdn.jsdelivr.net/npm/chart.js@2.7.3/dist/Chart.bundle.min.js"></script> -->
    	<!--Flot Chart-->
    	<!-- <script src="https://cdn.jsdelivr.net/npm/jquery.flot@0.8.3/jquery.flot.min.js"></script>
    	<script src="https://cdn.jsdelivr.net/npm/flot-spline@0.0.1/js/jquery.flot.spline.min.js"></script> -->


    	<!-- local -->
    	<script src="../assets/js/widgets.js"></script>


    	<!-- pie chart -->

    	<script src="https://cdn.jsdelivr.net/npm/flot-charts@0.8.3/excanvas.min.js"></script>
    	<script src="https://cdn.jsdelivr.net/npm/flot-charts@0.8.3/jquery.flot.min.js"></script>
    	<script src="https://cdn.jsdelivr.net/npm/jquery.flot@0.8.3/jquery.flot.pie.min.js"></script>
    	<script src="https://cdn.jsdelivr.net/npm/jquery.flot@0.8.3/jquery.flot.time.min.js"></script>
    	<script src="https://cdn.jsdelivr.net/npm/jquery.flot@0.8.3/jquery.flot.stack.js"></script>
    	<script src="https://cdn.jsdelivr.net/npm/jquery.flot@0.8.3/jquery.flot.resize.js"></script>
    	<script src="https://cdn.jsdelivr.net/npm/jquery.flot@0.8.3/jquery.flot.crosshair.js"></script>
    	<script src="https://cdn.jsdelivr.net/npm/flot.curvedlines@1.1.1/curvedLines.min.js"></script>
    	<script src="https://cdn.jsdelivr.net/npm/jquery.flot.tooltip@0.9.0/js/jquery.flot.tooltip.min.js"></script>
    	<script src="../assets/js/init/flot-chart-init.js"></script>




    </body>

    </html>