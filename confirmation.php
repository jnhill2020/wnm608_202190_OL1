<?php include('db_connect.php'); ?>

<?php
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$result = $conn->query("SELECT * FROM products WHERE id = $id");
$row = $result ? $result->fetch_assoc() : null;

$shipping = 5;
$total = $row ? $row['price'] + $shipping : 0;
?>

<?php include('parts/header.php'); ?>
<?php include('parts/nav.php'); ?>

<div class="container">
  <section class="confirmation card">
    <h2>Thank You for Your Purchase!</h2>
    <p>Your order has been placed successfully.</p>

    <?php if($row): ?>
      <p><strong>Item:</strong> <?= htmlspecialchars($row['name']) ?></p>
      <p><strong>Price:</strong> $<?= number_format($row['price'], 2) ?></p>
      <p><strong>Shipping:</strong> $<?= number_format($shipping, 2) ?></p>
      <p><strong>Total Paid:</strong> $<?= number_format($total, 2) ?></p>
    <?php else: ?>
      <p>No product information found.</p>
    <?php endif; ?>

    <p><strong>Order Number:</strong> BCC1026</p>
    <p><strong>Estimated Shipping:</strong> 5–7 business days</p>

    <a class="btn" href="products.php">Return to Shopping</a>
  </section>
</div>

<?php include('parts/footer.php'); ?>