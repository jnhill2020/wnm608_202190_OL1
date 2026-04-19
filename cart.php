<?php
session_start();
include('db_connect.php');
include('parts/header.php');
include('parts/nav.php');

if (!isset($_SESSION['cart'])) {
  $_SESSION['cart'] = [];
}

if (isset($_GET['add']) && isset($_GET['id'])) {
  $id = (int)$_GET['id'];
  $qty = isset($_GET['qty']) ? (int)$_GET['qty'] : 1;

  if ($qty < 1) {
    $qty = 1;
  }

  if (isset($_SESSION['cart'][$id])) {
    $_SESSION['cart'][$id] += $qty;
  } else {
    $_SESSION['cart'][$id] = $qty;
  }
}

if (isset($_GET['remove'])) {
  $remove_id = (int)$_GET['remove'];
  unset($_SESSION['cart'][$remove_id]);
}

$total = 0;
?>

<div class="container">
  <section class="page-intro">
    <h2>Your Cart</h2>
    <p>Items you selected.</p>
  </section>

  <?php if (!empty($_SESSION['cart'])): ?>
    <?php foreach ($_SESSION['cart'] as $id => $qty): ?>
      <?php
      $id = (int)$id;
      $result = $conn->query("SELECT * FROM products WHERE id = $id");
      $row = $result ? $result->fetch_assoc() : null;

      if (!$row) continue;

      $subtotal = $row['price'] * $qty;
      $total += $subtotal;
      ?>

      <div class="card">
        <img src="images/<?= htmlspecialchars($row['image']) ?>" alt="<?= htmlspecialchars($row['name']) ?>">

        <h3><?= htmlspecialchars($row['name']) ?></h3>
        <p><strong>Category:</strong> <?= htmlspecialchars($row['category']) ?></p>
        <p><strong>Price:</strong> $<?= number_format($row['price'], 2) ?></p>
        <p><strong>Quantity:</strong> <?= $qty ?></p>
        <p><strong>Subtotal:</strong> $<?= number_format($subtotal, 2) ?></p>
        <p><?= htmlspecialchars($row['description']) ?></p>

        <p>
          <a class="btn" href="cart.php?remove=<?= $row['id'] ?>">Remove Item</a>
        </p>
      </div>
    <?php endforeach; ?>

    <section class="card">
      <h3>Cart Total</h3>
      <p><strong>Total:</strong> $<?= number_format($total, 2) ?></p>
      <a class="btn" href="checkout.php">Proceed to Checkout</a>
    </section>

  <?php else: ?>
    <p>No items in cart.</p>
  <?php endif; ?>
</div>

<?php include('parts/footer.php'); ?>