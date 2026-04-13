<?php include('db_connect.php'); ?>
<?php include('parts/header.php'); ?>
<?php include('parts/nav.php'); ?>

<?php
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$result = $conn->query("SELECT * FROM products WHERE id = $id");
$row = $result ? $result->fetch_assoc() : null;
?>

<div class="container">
  <section class="page-intro">
    <h2>Your Cart</h2>
    <p>Items you selected.</p>
  </section>

  <?php if($row): ?>
    <div class="card">
      <h3><?= htmlspecialchars($row['name']) ?></h3>
      <p>Price: $<?= number_format($row['price'], 2) ?></p>
      <p><?= htmlspecialchars($row['description']) ?></p>

      <a class="btn" href="checkout.php">Proceed to Checkout</a>
    </div>
  <?php else: ?>
    <p>No item in cart.</p>
  <?php endif; ?>
</div>

<?php include('parts/footer.php'); ?>