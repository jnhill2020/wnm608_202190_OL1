<?php include('db_connect.php'); ?>

<?php
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$result = $conn->query("SELECT * FROM products WHERE id = $id");
$row = $result ? $result->fetch_assoc() : null;

$price = $row ? $row['price'] : 0;
$shipping = 5;
$total = $price + $shipping;
?>

<?php include('parts/header.php'); ?>
<?php include('parts/nav.php'); ?>

<div class="container">
  <section class="page-intro">
    <h2>Checkout</h2>
    <p>Enter your shipping and billing information to complete your order.</p>
  </section>

  <section class="shop-layout">
    <div class="card">
      <h3>Shipping Information</h3>

      <form class="form-stack">
        <input type="text" class="input" placeholder="Full Name">
        <input type="text" class="input" placeholder="Street Address">
        <input type="text" class="input" placeholder="City">
        <input type="text" class="input" placeholder="State">
        <input type="text" class="input" placeholder="Zip Code">

        <h3>Billing Information</h3>

        <input type="text" class="input" placeholder="Cardholder Name">
        <input type="text" class="input" placeholder="Card Number">
        <input type="text" class="input" placeholder="Expiration Date">
        <input type="text" class="input" placeholder="CVV">
      </form>
    </div>

    <aside class="card">
      <h3>Order Summary</h3>

      <?php if($row): ?>
        <p><strong>Item:</strong> <?= htmlspecialchars($row['name']) ?></p>
        <p>Subtotal: $<?= number_format($price, 2) ?></p>
        <p>Shipping: $<?= number_format($shipping, 2) ?></p>
        <p><strong>Total: $<?= number_format($total, 2) ?></strong></p>
      <?php else: ?>
        <p>No item selected.</p>
      <?php endif; ?>

      <a class="btn" href="confirmation.php">Complete Purchase</a>
    </aside>
  </section>
</div>

<?php include('parts/footer.php'); ?>