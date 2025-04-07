<html>
<body>
    <h1><?= htmlspecialchars($supplier->name) ?></h1>
    <p>Email: <?= htmlspecialchars($supplier->contact_email) ?></p>
    <p>Phone: <?= htmlspecialchars($supplier->phone) ?></p>
    
    <h2>Products</h2>
    <ul>
        <?php foreach ($products as $product): ?>
        <li>
            <a href="/product/<?= $product->id ?>">
                <?= htmlspecialchars($product->name) ?>
            </a>
        </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
