<html>
<head>
    <title>Products</title>
</head>
<body>
    <h1>Available Products</h1>
    
    <?php if (!empty($products)): ?>
        <ul>
        <?php foreach ($products as $product): ?>
            <li>
                <?= htmlspecialchars($product->name) ?> - 
                $<?= number_format($product->price, 2) ?>
                <a href="<?= base_url('product/' . $product->id) ?>">View</a>
            </li>
        <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No products available</p>
    <?php endif; ?>
</body>
</html>