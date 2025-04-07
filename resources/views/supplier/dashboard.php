<html>
<body>
    <h1>Suppliers</h1>
    
    <a href="/suppliers/create">Add New Supplier</a>
    
    <ul>
        <?php foreach ($suppliers as $supplier): ?>
        <li>
            <a href="/suppliers/<?= $supplier->id ?>">
                <?= htmlspecialchars($supplier->name) ?>
            </a>
        </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
