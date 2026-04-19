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
$order_number = "BCC" . rand(1000,9999);
?>

<div class="container">
  <section class="confirmation card">
    <h2>Thank You for Your Purchase!</h2>
    <p>Your order has been placed successfully.</p>

    <?php if (!empty($_SESSION['cart'])): ?>
      <?php foreach ($_SESSION['cart'] as $id => $qty): ?>
        <?php
        $id = (int)$id;
        $result = $conn->query("SELECT * FROM products WHERE id = $id");
        $row = $result ? $result->fetch_assoc() : null;

        if (!$row) continue;

        $item_total = $row['price'] * $qty;
        $subtotal += $item_total;
        ?>

        <p><strong>Item:</strong> <?= htmlspecialchars($row['name']) ?></p>
        <p><strong>Quantity:</strong> <?= $qty ?></p>
        <p><strong>Item Total:</strong> $<?= number_format($item_total, 2) ?></p>
        <hr>
      <?php endforeach; ?>

      <?php $total = $subtotal + $shipping; ?>

      <p><strong>Subtotal:</strong> $<?= number_format($subtotal, 2) ?></p>
      <p><strong>Shipping:</strong> $<?= number_format($shipping, 2) ?></p>
      <p><strong>Total Paid:</strong> $<?= number_format($total, 2) ?></p>

    <?php else: ?>
      <p>No product information found.</p>
    <?php endif; ?>

    <p><strong>Order Number:</strong> <?= $order_number ?></p>
    <p><strong>Estimated Shipping:</strong> 5–7 business days</p>

    <a class="btn" href="index.php">Return to Shopping</a>
  </section>
</div>

<?php
$_SESSION['cart'] = [];
include('parts/footer.php');
?>