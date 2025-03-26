<html>
<head>
    <title>Commission Tracking</title>
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 8px; text-align: left; border-bottom: 1px solid #ddd; }
        .pending { color: orange; font-weight: bold; }
        .paid { color: green; font-weight: bold; }
    </style>
</head>
<body>
    <h1>Commission Tracking</h1>
    
    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Supplier</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Payment Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($commissions as $commission): ?>
            <tr>
                <td><a href="/orders/<?= $commission->order_id ?>"><?= $commission->order_id ?></a></td>
                <td><?= htmlspecialchars($commission->supplier_name) ?></td>
                <td>$<?= number_format($commission->amount, 2) ?></td>
                <td class="<?= $commission->status ?>">
                    <?= ucfirst($commission->status) ?>
                </td>
                <td><?= $commission->payment_date ? date('m/d/Y', strtotime($commission->payment_date)) : 'N/A' ?></td>
                <td>
                    <?php if ($commission->status === 'pending'): ?>
                    <form action="/commissions/<?= $commission->id ?>/pay" method="POST" style="display:inline;">
                        <?= csrf_field() ?>
                        <button type="submit" style="background-color: #4CAF50; color: white; padding: 5px 10px; border: none; border-radius: 4px; cursor: pointer;">
                            Mark as Paid
                        </button>
                    </form>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
    <div style="margin-top: 20px;">
        <h3>Summary</h3>
        <?php
        $pending = array_sum(array_column(array_filter($commissions, fn($c) => $c->status === 'pending'), 'amount'));
        $paid = array_sum(array_column(array_filter($commissions, fn($c) => $c->status === 'paid'), 'amount'));
        ?>
        <p>Pending Commissions: <strong>$<?= number_format($pending, 2) ?></strong></p>
        <p>Paid Commissions: <strong>$<?= number_format($paid, 2) ?></strong></p>
        <p>Total: <strong>$<?= number_format($pending + $paid, 2) ?></strong></p>
    </div>
</body>
</html>
