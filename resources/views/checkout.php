<html>
<body>
    <h1>Checkout</h1>
    
    <form action="/checkout/place-order" method="POST">
        <h3>Your Information</h3>
        <label>Full Name:</label>
        <input type="text" name="name" required>
        
        <label>Email:</label>
        <input type="email" name="email" required>
        
        <h3>Order Summary</h3>
        <ul>
            <?php foreach ($items as $item): ?>
            <li>
                <?= htmlspecialchars($item->name) ?> - 
                <?= $item->quantity ?> x $<?= number_format($item->price, 2) ?>
            </li>
            <?php endforeach; ?>
        </ul>
        
        <button type="submit">Place Order</button>
    </form>
</body>
</html>
