<html>
<body>
    <h1>Your Products</h1>
    
    <a href="/products/create">Add New Product</a>
    
    <table border="1">
        <tr>
            <th>Name</th>
            <th>Price</th>
            <th>Image</th>
            <th>Action</th>
        </tr>
        <?php foreach ($products as $product): ?>
        <tr>
            <td><?= htmlspecialchars($product->name) ?></td>
            <td>$<?= number_format($product->price, 2) ?></td>
            <td>
                <?php if ($product->image_path): ?>
                <img src="/storage/<?= $product->image_path ?>" width="50">
                <?php endif; ?>
            </td>
            <td>
                <a href="/product/<?= $product->id ?>">View</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
