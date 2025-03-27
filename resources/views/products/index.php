<?php
view_include('layouts/header', [
    'title' => 'Product Page', 'user' => currentUser()
]);

?>
<div class="product-page">
    <h1>Available Products</h1>
    
    <?php if (!empty($products)): ?>
        <ul>
        <?php foreach ($products as $product): ?>
            <li>
                <?= htmlspecialchars($product->name) ?> - 
                $<?= number_format($product->price, 2) ?>
                <a href="<?= att_shop_base_url('product/' . $product->id) ?>">View</a>
            </li>
        <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No products available</p>
    <?php endif; ?>
</div>
<?php view_include('layouts/footer'); ?>
