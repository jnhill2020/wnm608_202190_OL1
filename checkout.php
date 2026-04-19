<?php
session_start();
include('db_connect.php');
include('parts/header.php');
include('parts/nav.php');

if (!isset($_SESSION['cart'])) {
  $_SESSION['cart'] = [];
}

$shipping = 5.00;
$subtotal = 0;
$total = 0;
?>

<div class="container">
  <section class="page-intro">
    <h2>Checkout</h2>
    <p>Enter your shipping and billing information to complete your order.</p>
  </section>

  <section class="shop-layout">
    <div class="card">
      <h3>Shipping Information</h3>

      <form class="form-stack" action="confirmation.php" method="post">
        <input type="text" class="input" name="fullname" placeholder="Full Name" required>
        <input type="text" class="input" name="address" placeholder="Street Address" required>
        <input type="text" class="input" name="city" placeholder="City" required>
        <input type="text" class="input" name="state" placeholder="State" required>
        <input type="text" class="input" name="zip" placeholder="Zip Code" required>

        <h3>Billing Information</h3>

        <input type="text" class="input" name="cardname" placeholder="Cardholder Name" required>
        <input type="text" class="input" name="cardnumber" placeholder="Card Number" required>
        <input type="text" class="input" name="expdate" placeholder="Expiration Date" required>
        <input type="text" class="input" name="cvv" placeholder="CVV" required>

        <button class="btn" type="submit">Complete Purchase</button>
      </form>
    </div>

    <aside class="card">
      <h3>Order Summary</h3>

      <?php if (!empty($_SESSION['cart'])): ?>
        <?php foreach ($_SESSION['cart'] as $item): ?>
          <?php
          $id = (int)$item['id'];
          $qty = (int)$item['qty'];
          $style = htmlspecialchars($item['style']);
          $color = htmlspecialchars($item['color']);

          $result = $conn->query("SELECT * FROM products WHERE id = $id");
          $row = $result ? $result->fetch_assoc() : null;

          if (!$row) continue;

          $item_total = $row['price'] * $qty;
          $subtotal += $item_total;
          ?>

          <p><strong>Item:</strong> <?= htmlspecialchars($row['name']) ?></p>
          <p><strong>Style:</strong> <?= $style ?></p>
          <p><strong>Color:</strong> <?= $color ?></p>
          <p><strong>Quantity:</strong> <?= $qty ?></p>
          <p><strong>Item Total:</strong> $<?= number_format($item_total, 2) ?></p>
          <hr>
        <?php endforeach; ?>

        <?php $total = $subtotal + $shipping; ?>

        <p>Subtotal: $<?= number_format($subtotal, 2) ?></p>
        <p>Shipping: $<?= number_format($shipping, 2) ?></p>
        <p><strong>Total: $<?= number_format($total, 2) ?></strong></p>

      <?php else: ?>
        <p>No items in cart.</p>
      <?php endif; ?>
    </aside>
  </section>
</div>

<?php include('parts/footer.php'); ?>