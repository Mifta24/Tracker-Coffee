<?php
session_start();
include '../database/db.php';
if ($_SESSION['status'] != "login") {
    header("location:../login/login.php?pesan=belum_login");
}

$id = $_GET['id'];

$pembayaran = mysqli_query($conn, "SELECT * FROM tbl_pembayaran WHERE id=$id");
$row = mysqli_fetch_array($pembayaran);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Detail Pembayaran</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet" />

    <!-- Feather Icons -->
    <script src="https://unpkg.com/feather-icons"></script>

    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .menu {
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .menu-card {
            text-align: center;
            margin: 0 auto;
        }

        .menu-card-img {
            width: 100%;
            max-width: 600px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .judul {
            font-size: 1.5rem;
            margin-bottom: 20px;
            color: #343a40;
        }

        .close {
            display: inline-block;
            margin-bottom: 20px;
            color: #007bff;
            font-size: 1.5rem;
            text-decoration: none;
        }

        .close i {
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <!-- Menu Section Start -->
    <section class="menu container mt-4">
        <a class="close" href="penjualan.php">
            <i data-feather="x-circle"></i> Kembali
        </a>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="menu-card">
                    <h2 class="judul">Bukti Pembayaran</h2>
                    <img
                        class="menu-card-img"
                        src="../img/bukti-pembayaran/<?php echo htmlspecialchars($row['bukti_pembayaran']); ?>"
                        alt="Bukti Pembayaran"
                    />
                </div>
            </div>
        </div>
    </section>
    <!-- Menu Section End -->

    <!-- Feather Icons -->
    <script>
        feather.replace();
    </script>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UOa6M4u8Kbd6z6fx9cLUJ4wvE+MTFnt5Z0t7r54Ve9F8VVxPpFlaUgt6ZnD/U0lD" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+dAK3QydEWTyI15E12odrGhQV0aPd5npQ1d9m00p6F6k3l57x" crossorigin="anonymous"></script>
</body>
</html>
