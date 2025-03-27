<html>

<head>
    <title><?= htmlspecialchars($product->name) ?></title>
</head>

<body>
    <a href="javascript:history.back()">Back to search</a>

    <h1><?= htmlspecialchars($product->name) ?></h1>
    <p>Precio: $<?= number_format($product->price, 2) ?></p>

    <?php if ($product->image_path): ?>
        <img src="/images/<?= $product->image_path ?>" width="300">
    <?php endif; ?>

    <h3>Descripcion</h3>
    <p><?= nl2br(htmlspecialchars($product->description)) ?></p>
    <form action="<?=att_shop_base_url('/cart/add')?>" method="POST">
    <?= csrf_field() ?>
    <input type="hidden" name="product_id" value="<?= $product->id ?>">
        <button type="submit">Add to Cart</button>
    </form>
</body>

</html>