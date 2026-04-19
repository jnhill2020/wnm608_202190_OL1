<?php include('db_connect.php'); ?>
<?php include('parts/header.php'); ?>
<?php include('parts/nav.php'); ?>

<?php
$result = $conn->query("SELECT * FROM products");
?>

<div class="container">

  <section class="hero">
    <h2>Cozy season essentials</h2>
    <p>Handmade crochet pieces designed for comfort and cozy everyday style.</p>
  </section>

  <section class="product-list">
    <h2>Shop Products</h2>

    <div class="cards">
      <?php while($row = $result->fetch_assoc()): ?>
        <div class="card">
          <img src="images/<?= htmlspecialchars($row['image']) ?>" alt="<?= htmlspecialchars($row['name']) ?>">

          <h3><?= htmlspecialchars($row['name']) ?></h3>
          <p>$<?= number_format($row['price'], 2) ?></p>

          <form action="cart.php" method="get">
            <input type="hidden" name="id" value="<?= $row['id'] ?>">

            <label for="qty<?= $row['id'] ?>">Qty:</label>
            <input type="number" id="qty<?= $row['id'] ?>" name="qty" value="1" min="1">

            <button class="btn" type="submit" name="add">Add to Cart</button>
          </form>

          <p><a class="btn" href="product.php?id=<?= $row['id'] ?>">View Item</a></p>
        </div>
      <?php endwhile; ?>
    </div>
  </section>

  <section class="newsletter">
    <h3>Join the newsletter</h3>
    <p>Get updates on new crochet drops and cozy collections.</p>

    <form class="newsletter-form">
      <input
        type="email"
        class="input"
        placeholder="Enter your email address"
        required
      >
      <button class="btn btn--hero" type="submit">Subscribe</button>
    </form>
  </section>

</div>

<?php include('parts/footer.php'); ?>