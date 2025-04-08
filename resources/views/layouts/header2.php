<!DOCTYPE html>
<html lang="en" data-bs-theme="light" data-pwa="true">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover">
  <meta name="csrf-token" content="<?= csrf_token() ?>">

  <title><?= $title ?? 'Al-tin-tin | Marketplace' ?></title>

  <!-- Webmanifest + Favicon / App icons -->
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <link rel="icon" type="image/png" href="assets/app-icons/icon-32x32.png" sizes="32x32">
  <link rel="apple-touch-icon" href="assets/app-icons/icon-180x180.png">
  
     <!-- Bootstrap -->
     <link href="/lib/bootstrap-5.3.3/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/lib/bootstrap-icons-1.11.3/bootstrap-icons.min.css">
    <!--link rel="stylesheet" href="/lib/swiper/swiper-bundle.min.css"-->
    <link href="/assets/css/att.css" rel="stylesheet">

    <style>

    </style>

</head>
<body>
    <!-- Top Navigation Row -->
    <nav class="navbar navbar-light bg-light p-0">
        <div class="container-fluid">
            <!-- Top Row -->
            <div class="navbar-top">
                <!-- Logo -->
                <a class="navbar-brand me-3" href="#">
                    <img src="/assets/att-logo1.png" alt="Logo" height="40">
                </a>

                <!-- Departments Button -->
                <div class="me-3">
                    <button class="btn btn-outline-secondary departments-btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#departmentsOffcanvas">
                        <i class="bi bi-grid-fill"></i>
                        <span class="nav-item-text ms-1">Departamentos</span>
                        <span class="menu-chevron"></span><!--i class="bi bi-chevron-down ms-1 departments-chevron"></i-->
                    </button>
                </div>

                <!-- Search Container (grows when space available) -->
                <div class="search-container d-none d-lg-flex">
                    <div class="input-group search-box">
                        <input type="text" class="form-control border-0" placeholder="Buscar...">
                        <button class="btn btn-outline-secondary border-0" type="button">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </div>

                <!-- Search Toggle (Visible on mobile) -->
                <button class="btn btn-outline-secondary d-lg-none me-auto search-toggle" type="button">
                    <i class="bi bi-search"></i>
                </button>

                <!-- Account -->
                <div class="me-3">
                    <a class="nav-link" href="/customer/dashboard">
                        <i class="bi bi-person-fill"></i>
                        <span class="account-name ms-1">huesped</span>
                        <span class="menu-chevron"></span><!--i class="bi bi-chevron-down ms-1"></i-->
                    </a>
                </div>

                <!-- Delivery (Desktop version) -->
                <div class="me-3 delivery-desktop">
                    <a class="nav-link" href="#delivery">
                        <i class="bi bi-geo-alt-fill"></i>
                        <span class="ms-1">Entrega a </span>
                        <span class="fw-bold">Maria - Ciego de Avila</span>
                        <span class="menu-chevron"></span><!--i class="bi bi-chevron-down ms-1"></i-->
                    </a>
                </div>

                <!-- Shopping Cart -->
                <a class="nav-link" href="#cart">
                    <i class="bi bi-cart-fill position-relative">
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            3
                        </span>
                    </i>
                </a>
            </div>

            <!-- Delivery Row (Mobile only) -->
            <div class="delivery-row">
                <a class="nav-link" href="#delivery">
                    <i class="bi bi-geo-alt-fill"></i>
                    <span>Deliver to </span>
                    <span class="fw-bold">Maria - Ciego de Avila</span>
                    <span class="menu-chevron"></span><!--i class="bi bi-chevron-down ms-1"></i-->
                </a>
            </div>
        </div>
    </nav>

    <!-- Expanded Search (hidden by default) -->
    <div class="container-fluid search-expanded bg-light py-2">
        <div class="container">
            <div class="input-group search-box">
                <input type="text" class="form-control border-0" placeholder="Buscar...">
                <button class="btn btn-outline-secondary border-0 search-go" type="button">
                    <i class="bi bi-search"></i> Buscar
                </button>
            </div>
        </div>
    </div>

    <!-- Departments Offcanvas -->
    <div class="offcanvas offcanvas-start offcanvas-departments" tabindex="-1" id="departmentsOffcanvas">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title">Departamentos</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="list-group">
                <li class="list-group-item">Electronics</li>
                <li class="list-group-item">Clothing</li>
                <li class="list-group-item">Home & Kitchen</li>
                <li class="list-group-item">Grocery</li>
                <li class="list-group-item">Toys</li>
            </ul>
        </div>
    </div>
