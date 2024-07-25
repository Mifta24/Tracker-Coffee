<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <style>
      body {
      font-family: 'Poppins', sans-serif;
      background-color: #f8f9fa;
    }

    .footer {
    background-color: #222;
    color: #ddd;
    padding-top: 40px;
    padding-bottom: 20px;
    font-family: 'Poppins', sans-serif;
}

.footer h5 {
    color: #fff;
    font-weight: 600;
    margin-bottom: 20px;
}

.footer p,
.footer a {
    color: #aaa;
    font-size: 14px;
    line-height: 1.7;
}

.footer a:hover {
    color: #bb6a00;
    text-decoration: none;
}

.footer .social-icons a {
    display: inline-block;
    margin-right: 15px;
    font-size: 20px;
    transition: color 0.3s ease;
}

.footer .social-icons a:hover {
    color: #bb6a00;
}

.footer .list-unstyled {
    padding-left: 0;
    list-style: none;
}

.footer .text-warning {
    color: #bb6a00 !important;
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


    </style>


    <title>Admin</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary sticky-top p-3">
      <a class="navbar-brand" href="admin.php">Cateringku.</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="admin.php">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Master Data
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="kategori.php">Kategori</a>
              <a class="dropdown-item" href="produk.php">Produk</a>
              <a class="dropdown-item" href="pemesanan.php">Pemesanan</a>
              <a class="dropdown-item" href="penjualan.php">Penjualan</a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="user.php">Kelola User</a>
          </li>
        </ul>

        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="profil.php">Profile</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
          </li>
        </ul>
      </div>
    </nav>

    <div class="container-fluid">

    
