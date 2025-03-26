<html>
<body>
    <h1>Order Management</h1>
    
    <table border="1">
        <tr>
            <th>Order ID</th>
            <th>Customer</th>
            <th>Total</th>
            <th>Status</th>
            <th>Date</th>
            <th>Items</th>
            <th>Action</th>
        </tr>
        <?php foreach ($orders as $order): ?>
        <tr>
            <td><?= $order->id ?></td>
            <td><?= htmlspecialchars($order->customer_name) ?></td>
            <td>$<?= number_format($order->total, 2) ?></td>
            <td><?= $order->status ?></td>
            <td><?= $order->created_at ?></td>
            <td><?= $order->item_count ?></td>
            <td><a href="/orders/<?= $order->id ?>">View</a></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
