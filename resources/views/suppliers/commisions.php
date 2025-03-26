<html>
<head>
    <title>My Commissions</title>
    <style>
        /* Same styling as commissions/index.php */
    </style>
</head>
<body>
    <h1>Commission Report for <?= htmlspecialchars($supplier->name) ?></h1>
    
    <table>
        <!-- Same table structure as commissions/index.php -->
        <!-- Remove the "Mark as Paid" action column -->
    </table>
    
    <div style="margin-top: 20px;">
        <h3>Summary</h3>
        <?php
        $pending = array_sum(array_column(array_filter($commissions, fn($c) => $c->status === 'pending'), 'amount'));
        $paid = array_sum(array_column(array_filter($commissions, fn($c) => $c->status === 'paid'), 'amount'));
        ?>
        <p>Pending Commissions: <strong>$<?= number_format($pending, 2) ?></strong></p>
        <p>Paid Commissions: <strong>$<?= number_format($paid, 2) ?></strong></p>
        <p>Total Earned: <strong>$<?= number_format($pending + $paid, 2) ?></strong></p>
    </div>
    
    <a href="/suppliers/<?= $supplierId ?>">Back to Supplier Profile</a>
</body>
</html>
