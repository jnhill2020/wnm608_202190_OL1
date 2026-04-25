<?php
include('db_connect.php');
include('parts/header.php');
include('parts/nav.php');

if (!isset($_SESSION['cart'])) {
  $_SESSION['cart'] = [];
}

if (isset($_GET['add']) && isset($_GET['id'])) {
  $id = (int)$_GET['id'];
  $qty = isset($_GET['qty']) ? (int)$_GET['qty'] : 1;
  $style = isset($_GET['style']) ? trim($_GET['style']) : 'Classic';
  $color = isset($_GET['color']) ? trim($_GET['color']) : 'Red';

  if ($qty < 1) {
    $qty = 1;
  }

  $_SESSION['cart'][] = [
    'id' => $id,
    'qty' => $qty,
    'style' => $style,
    'color' => $color
  ];
}

if (isset($_GET['remove'])) {
  $remove_index = (int)$_GET['remove'];

  if (isset($_SESSION['cart'][$remove_index])) {
    unset($_SESSION['cart'][$remove_index]);
    $_SESSION['cart'] = array_values($_SESSION['cart']);
  }
}

$total = 0;
?>

<div class="container">
  <section class="page-intro">
    <h2>Your Cart</h2>
    <p>Items you selected.</p>
  </section>

  <?php if (!empty($_SESSION['cart'])): ?>

    <?php foreach ($_SESSION['cart'] as $index => $item): ?>
      <?php
      $id = (int)$item['id'];
      $qty = (int)$item['qty'];
      $style = htmlspecialchars($item['style']);
      $color = htmlspecialchars($item['color']);

      $result = $conn->query("SELECT * FROM products WHERE id = $id");
      $row = $result ? $result->fetch_assoc() : null;

      if (!$row) continue;

      $subtotal = $row['price'] * $qty;
      $total += $subtotal;
      ?>

      <div class="card cart-item-card">
        <img src="images/<?= htmlspecialchars($row['image']) ?>" alt="<?= htmlspecialchars($row['name']) ?>">

        <div>
          <h3><?= htmlspecialchars($row['name']) ?></h3>
          <p><strong>Category:</strong> <?= htmlspecialchars($row['category']) ?></p>
          <p><strong>Price:</strong> $<?= number_format($row['price'], 2) ?></p>
          <p><strong>Style:</strong> <?= $style ?></p>
          <p><strong>Color:</strong> <?= $color ?></p>
          <p><strong>Quantity:</strong> <?= $qty ?></p>
          <p><strong>Subtotal:</strong> $<?= number_format($subtotal, 2) ?></p>
          <p><?= htmlspecialchars($row['description']) ?></p>

          <a class="btn" href="cart.php?remove=<?= $index ?>">Remove Item</a>
        </div>
      </div>

    <?php endforeach; ?>

    <section class="card cart-total">
      <h3>Cart Total</h3>
      <p><strong>Total:</strong> $<?= number_format($total, 2) ?></p>
      <a class="btn" href="checkout.php">Proceed to Checkout</a>
    </section>

  <?php else: ?>

    <section class="card confirmation">
      <p>No items in cart.</p>
      <a class="btn" href="products.php">Continue Shopping</a>
    </section>

  <?php endif; ?>
</div>

<?php include('parts/footer.php'); ?>