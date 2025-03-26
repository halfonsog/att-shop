<html>
<body>
    <h1>Order #<?= $order->id ?></h1>
    
    <h3>Customer Info</h3>
    <p>Name: <?= htmlspecialchars($order->customer_name) ?></p>
    <p>Email: <?= htmlspecialchars($order->customer_email) ?></p>
    
    <h3>Order Details</h3>
    <table border="1">
        <tr>
            <th>Product</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
        </tr>
        <?php foreach ($items as $item): ?>
        <tr>
            <td><?= htmlspecialchars($item->name) ?></td>
            <td>$<?= number_format($item->price, 2) ?></td>
            <td><?= $item->quantity ?></td>
            <td>$<?= number_format($item->price * $item->quantity, 2) ?></td>
        </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="3"><strong>Grand Total</strong></td>
            <td><strong>$<?= number_format($order->total, 2) ?></strong></td>
        </tr>
    </table>
    
    <h3>Update Status</h3>
    <form action="/orders/<?= $order->id ?>/status" method="POST">
        <select name="status">
            <option value="pending" <?= $order->status === 'pending' ? 'selected' : '' ?>>Pending</option>
            <option value="processing" <?= $order->status === 'processing' ? 'selected' : '' ?>>Processing</option>
            <option value="completed" <?= $order->status === 'completed' ? 'selected' : '' ?>>Completed</option>
            <option value="cancelled" <?= $order->status === 'cancelled' ? 'selected' : '' ?>>Cancelled</option>
        </select>
        <button type="submit">Update</button>
    </form>
</body>
</html>
