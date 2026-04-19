<?php include('db_connect.php'); ?>
<?php include('parts/header.php'); ?>
<?php include('parts/nav.php'); ?>

<?php
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$result = $conn->query("SELECT * FROM products WHERE id = $id");

if (!$result || $result->num_rows == 0) {
  echo "<div class='container'><p>Product not found.</p></div>";
  include('parts/footer.php');
  exit;
}

$row = $result->fetch_assoc();
?>

<div class="container">
  <section class="page-intro">
    <h2><?= htmlspecialchars($row['name']) ?></h2>
    <p>Product details for this handmade crochet item.</p>
  </section>

  <section class="product-single card">
    <div class="product-image">
      <img src="images/<?= htmlspecialchars($row['image']) ?>" alt="<?= htmlspecialchars($row['name']) ?>">
    </div>

    <div class="product-info">
      <h3><?= htmlspecialchars($row['name']) ?></h3>
      <p><strong>Category:</strong> <?= htmlspecialchars($row['category']) ?></p>
      <p><strong>Price:</strong> $<?= number_format($row['price'], 2) ?></p>
      <p><?= htmlspecialchars($row['description']) ?></p>

      <form action="cart.php" method="get" class="product-form">
        <input type="hidden" name="id" value="<?= $row['id'] ?>">

        <label for="style">Style:</label>
        <select id="style" name="style" class="input" required>
          <option value="Classic">Classic</option>
          <option value="Custom">Custom</option>
          <option value="Gift Wrapped">Gift Wrapped</option>
        </select>

        <label for="color">Color:</label>
        <select id="color" name="color" class="input" required>
          <option value="Red">Red</option>
          <option value="Blue">Blue</option>
          <option value="Yellow">Yellow</option>
          <option value="Green">Green</option>
          <option value="Orange">Orange</option>
          <option value="Purple">Purple</option>
        </select>

        <label for="qty">Quantity:</label>
        <input type="number" id="qty" name="qty" value="1" min="1" required>

        <button class="btn" type="submit" name="add">Add to Cart</button>
      </form>
    </div>
  </section>
</div>

<?php include('parts/footer.php'); ?>