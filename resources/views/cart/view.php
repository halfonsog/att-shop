<html>

<body>
  <h1>Your Shopping Cart</h1>

  <?php if (empty($items)): ?>
    <p>Your cart is empty</p>
  <?php else: ?>
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
          <td>$<?= number_format($item->total, 2) ?></td>
          
          <td>
            <form action="/cart/update" method="POST" style="display:inline;">
              <input type="hidden" name="product_id" value="<?= $item->id ?>">
              <input type="number" name="quantity" value="<?= $item->quantity ?>" min="1" style="width:50px;">
              <button type="submit">Update</button>
            </form>

            <form action="/cart/remove" method="POST" style="display:inline;">
              <input type="hidden" name="product_id" value="<?= $item->id ?>">
              <button type="submit">Remove</button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
      <tr>
        <td colspan="3"><strong>Grand Total</strong></td>
        <td><strong>$<?= number_format($total, 2) ?></strong></td>
      </tr>
    </table>
  <?php endif; ?>

  <a href="/search">Continue Shopping</a>
</body>

</html>