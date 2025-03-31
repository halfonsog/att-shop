<!DOCTYPE html>
<html>
  <meta charset="utf-8">
  <meta name="csrf-token" content="<?= csrf_token() ?>">
  <meta http-equiv="Content-Security-Policy" content="default-src 'self' data: gap: https://ssl.gstatic.com; style-src 'self' 'unsafe-inline'; media-src *; script-src 'self' 'unsafe-inline' 'unsafe-eval'; connect-src *">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no" />
  <meta name="apple-mobile-web-app-capable" content="yes" />
  <meta name="apple-mobile-web-app-status-bar-style" content="black" />
<head>
  <title><?= $title ?? 'Al-tin-tin Shop' ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>  <link rel="stylesheet" href="/css/att.css" /> 
</head>
<body>
  <header>
    <div class="top-bar">
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
    </div>
@supplier
    <!-- Show supplier dashboard link -->
@endsupplier

@customer
    <!-- Show cart button -->
@endcustomer
    
  </header>
  <main>
  