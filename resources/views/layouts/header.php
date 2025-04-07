<!DOCTYPE html>
<html lang="en" data-bs-theme="light" data-pwa="true">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover">
  <meta name="csrf-token" content="<?= csrf_token() ?>">

  <title><?= $title ?? 'Al-tin-tin | Marketplace' ?></title>
  <meta name="description" content="Al-tin-tin - Compras para toda cuba desde donde estes">
  <meta name="keywords" content="cuba, online shop, compras, e-commerce, online store, tienda online, supermercado, comida, ayuda a cuba">

  <!-- Webmanifest + Favicon / App icons -->
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <link rel="icon" type="image/png" href="assets/app-icons/icon-32x32.png" sizes="32x32">
  <link rel="apple-touch-icon" href="assets/app-icons/icon-180x180.png">
  
  <link href="/lib/bootstrap-5.3.3/bootstrap.min.css" rel="stylesheet" >  
  <link rel="stylesheet" href="/css/att.css" /> 
</head>
<body>
  <!--div class="top-bar">
    <a href="/"><img src="/logo.png" class="logo"></a>
    <div class="search-box">
      <form action="/search">
        <input type="text" name="q" placeholder="Search products...">
        <button type="submit"><i class="fa fa-search"></i></button>
      </form>
    </div>
    <nav>
      <a href="/account">Hello, <?= $user['name'] ?? 'Guest' ?></a>
      <a href="/cart"><i class="fa fa-shopping-cart"></i> Cart</a>
    </nav>
  </div-->

  <!-- Shopping cart offcanvas -->
  <div class="offcanvas offcanvas-end pb-sm-2 px-sm-2" id="shoppingCart" tabindex="-1" aria-labelledby="shoppingCartLabel" style="width: 500px">

  <!-- Header -->
  <div class="offcanvas-header flex-column align-items-start py-3 pt-lg-4">
    <div class="d-flex align-items-center justify-content-between w-100 mb-3 mb-lg-4">
      <h4 class="offcanvas-title" id="shoppingCartLabel">Shopping cart</h4>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="alert alert-success text-dark-emphasis fs-sm border-0 rounded-4 mb-0" role="alert">
      Congratulations 🎉 You have added more than <span class="fw-semibold">$50</span> to your cart. <span class="fw-semibold">Delivery is free</span> for you!
    </div>
  </div>

    
  </header>
  <main>
  