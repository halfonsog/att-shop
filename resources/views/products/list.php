<html>
<head>
    <title>Product Search</title>
    <style>
        .product { border: 1px solid #ddd; padding: 10px; margin: 10px; }
        .product:hover { background-color: #f5f5f5; cursor: pointer; }
    </style>
</head>
<body>
    <h1>Search Results for "<?= htmlspecialchars($searchTerm) ?>"</h1>
    
    <div class="product-list">
        <?php foreach ($products as $product): ?>
            <div class="product" 
                 onclick="window.location='/product/<?= $product->id ?>'">
                <h3><?= htmlspecialchars($product->name) ?></h3>
                <p>$<?= number_format($product->price, 2) ?></p>
                <?php if ($product->image_path): ?>
                    <img src="/images/<?= $product->image_path ?>" width="100">
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
