<!DOCTYPE html>
<html>
<head>
  <title><?= $title ?? 'ATT-Shop' ?></title>
  <link href="/css/amazon-style.css" rel="stylesheet">
  <!-- Font Awesome for icons -->
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
  