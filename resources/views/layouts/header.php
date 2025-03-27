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
  <link rel="stylesheet" href="/lib/framework7/css/framework7.ios.min.css" />
		<!--link rel="stylesheet" href="/lib/framework7.ios.colors.min.css"-->
    <link rel="stylesheet" href="/lib/framework7-icons/css/framework7-icons.css" /> 
    <link rel="stylesheet" href="/lib/att.css" /> 
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
  </header>
  <main>
  