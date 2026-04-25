<header>
  <h1>Blush & Cozy Crochet</h1>
  <p>Handmade crochet pieces for cozy everyday living</p>
</header>

<?php
$count = 0;

if (isset($_SESSION['cart'])) {
  foreach ($_SESSION['cart'] as $item) {
    $count += $item['qty'];
  }
}
?>

<nav>
  <a href="index.php">Home</a>
  <a href="products.php">Shop</a>

  <a href="cart.php" class="cart-link">
    Cart
    <?php if ($count > 0): ?>
      <span class="cart-badge"><?= $count ?></span>
    <?php endif; ?>
  </a>

  <a href="checkout.php">Checkout</a>
</nav>